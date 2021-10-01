<?php

namespace App\Http\Controllers;

use App\Helpers\Aid;
use App\Models\{Cart, Order, Product};
use App\Http\Requests\StoreOrderRequest;
use App\Jobs\ProcessOrder;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Throwable;

class OrderController extends Controller
{
    /**
     * @throws Exception
     */
    public function showCheckout(): View|Factory|RedirectResponse|Application {
        if(getCart('count') > 0) {
            $cartItems = Cart::cartItems();

            $message = null;
            foreach($cartItems as $item) {
                // Prevent ordering of disabled products
                $productStatus = Product::status($item->product_id);

                if(!$productStatus) $message = "Sorry, {$item->product->title} is currently unavailable.";

                // Prevent ordering of products out of stock
                $stock = Product::stock($item->product_id, "min", $item->details);

                if(!$stock) $message = "Sorry, {$item->product->title} JUST ran out of stock🤧";

                // Prevent order of disabled variations
                if($item->details) {
                    $attributesAvailable = Product::attributesAreAvailable($item->product_id, $item->details);

                    if($attributesAvailable) {
                        $message = "Sorry, $attributesAvailable {$item->product->title} is currently unavailable.🤧";
                    }
                }

                // Prevent order of disabled categories
                $categoryStatus = $item->product->subCategory->category->status;
                $subCategoryStatus = $item->product->subCategory->status;
                if(!$categoryStatus || !$subCategoryStatus) $message = "Sorry, {$item->product->title} is currently unavailable.🤧";

                if($message)
                    return back()->with('alert', ['type' => 'info', 'intro' => 'Sorry😭!', 'message' => $message, 'duration' => 7]);
            }

            $data = [
                'cart' => $cartItems,
                'addresses' => Auth::user()->addresses,
                'phones' => Auth::user()->phones,
                'metaDesc' => 'Suf store checkout',
            ];

            return view('checkout', $data);
        }

        $message = "You do not have any items in your cart yet.";
        return back()->with('alert', ['type' => 'info', 'intro' => 'Oops🤭!', 'message' => $message, 'duration' => 7]);
    }

    public function showOrders(): Factory|View|Application {
        $data = [
            'page' => "orders",
            'orders' => Order::usersOrders()->orderByDesc('created_at')->get()
        ];

        return view('profile', $data);
    }

    /**
     * @throws Exception
     */
    public function placeOrder(StoreOrderRequest $req): Redirector|RedirectResponse|Application {
        $data = $req->all();

        if(!$req->has('address')) {
            $data['address'] = null;
            /*$message = "Please provide a delivery address. Add at least one if there is none.";
            return back()->with('alert', ['type' => 'info', 'intro' => 'heyy!', 'message' => $message, 'duration' => 7]);*/
        }

        //  Extract Payment Method and Type
        if(Str::contains(Str::lower($data['payment_method']),'m-pesa')) {
            $paymentMethod = 'm-pesa';
            if(Str::contains(Str::lower($data['payment_method']),'delivery')) {
                $paymentType = 'on-delivery';
            } else {
                $paymentType = 'instant';
            }
        } else if(Str::contains(Str::lower($data['payment_method']),'paypal')) {
            $paymentMethod = 'paypal';
            $paymentType = 'instant';
        } else {
            $paymentMethod = 'cash';
            $paymentType = 'on-delivery';
        }

        try {
            $data['total'] = getCart('total');

            $order = DB::transaction(function() use ($paymentType, $paymentMethod, $data) {
                $phone = Str::length($data['phone']) > 9 ? Str::substr($data['phone'], -9) : $data['phone'];

                //  Insert Order Details
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'order_no' => mt_rand(1, 100),
                    'address_id' => $data['address'],
                    'phone' => $phone,
                    'coupon_id' => Session::get('couponId'),
                    'discount' => currencyToFloat(Session::get('couponDiscount')),
                    'payment_method' => $paymentMethod,
                    'payment_type' => $paymentType,
                    'total' => currencyToFloat($data['total']),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                $order->order_no = "SUF-$order->id";
                $order->save();

                return $order;
            });

            $user = [
                'first_name' => Auth::user()->first_name,
                'gender' => Auth::user()->gender,
                'email' => Auth::user()->email,
                'session_id' => Session::get('session_id'),
            ];

            ProcessOrder::dispatch($order, Cart::cartItems(), $user);

            //  Add orderId and grandTotal to session
            Session::put('grandTotal', $order->total);
            Session::put('orderId', $order->order_no);
        } catch (Exception | Throwable $e) {
            Log::error($e);

            return Aid::createFail("Unable to place order! Please contact @Lè_•Çapuchôn✓🩸");
        }

        Session::put('cartTotal', 0.00);
        Session::put('cartCount', 0);

        //  Redirect to payment page
        if($paymentMethod === 'paypal') {
            return redirect()->route('paypal');
        } else if($paymentMethod === 'm-pesa' & $paymentType === 'instant') {
            return redirect()->route('mpesa');
        } else {
            return Aid::createOk("Your Order has been Placed! 🥳 You shall receive an email shortly.", 'thank-you');
        }
    }

    public function thankYou(): View|Factory|Redirector|RedirectResponse|Application {
        return Session::has('orderId') ? view('thanks') : redirect('/cart');
    }
}
