<?php

namespace App\Http\Controllers;

use App\Models\{Address, Cart, Order, OrdersProduct};
use App\Mail\OrderPlaced;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use JsonException;

class OrderController extends Controller
{
    /**
     * @throws JsonException
     */
    public function checkout(): View|Factory|RedirectResponse|Application
    {
        $cart = Cart::cartItems();

        if(cartCount() > 0) {
            $addresses = Address::addresses()->get()->toArray();
            $phones = Auth::user()->phones->toArray();

            return view('checkout')->with(compact('cart', 'addresses', 'phones'));
        }

        $message = "You do not have any items in your cart yet.";
        return back()->with('alert', ['type' => 'info', 'intro' => 'Oops🤭!', 'message' => $message, 'duration' => 7]);
    }

    public function showOrders(): Factory|View|Application
    {
        $page = "orders";

        $orders = Order::usersOrders()->orderByDesc('created_at')->get()->toArray();

        return view('profile')->with(compact('page', 'orders'));
    }

    /**
     * @throws JsonException
     */
    public function placeOrder(Request $req): Redirector|RedirectResponse|Application
    {
        if($req->isMethod('POST')) {
            $data = $req->all();

            if(!$req->has('address')) {
                $message = "Please provide a delivery address. Add at least one if there is none.";
                return back()->with('alert', ['type' => 'info', 'intro' => 'heyy!', 'message' => $message, 'duration' => 7]);
            }

            $req->validate([
                'address' => 'bail|present|required|integer|exists:addresses,id',
                'phone' => 'present|required|integer|exists:phones,id',
                'payment_method' => 'present|required|alpha_dash',
            ], [
                'address.required' => 'Please choose a delivery address or add one if you can\'t see the one you\'re looking for',
                'phone.required' => 'Please Select a phone number so we can keep in touch during the order process',
                'payment_method.required' => 'Please Select a payment method.'
            ]);

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
                echo "<h2>Paypal payment Coming Soon!</h2>"; die;
            } else {
                $paymentMethod = 'cash';
                $paymentType = 'on-delivery';
            }

            //  Only allow cash payments for now    //////////////////////////
            if($paymentMethod !== 'cash') {
                $message = "Prepaid method coming soon!";
                return back()->with('alert', ['type' => 'info', 'intro' => 'Great!', 'message' => $message, 'duration' => 7]);
            }

            if(!session::has('grandTotal')) {
                Session::put('grandTotal', cartTotal());
            }

            try {
                DB::transaction(function() use ($paymentType, $paymentMethod, $data) {
                    $cart = Cart::cartItems();

                    //  Insert Order Details
                    $orderId = Order::insertGetId([
                        'user_id' => Auth::id(),
                        'address_id' => $data['address'],
                        'phone_id' => $data['phone'],
                        'coupon_id' => Session::get('couponId'),
                        'discount' => currencyToFloat(Session::get('couponDiscount')),
                        'payment_method' => $paymentMethod,
                        'payment_type' => $paymentType,
                        'total' => currencyToFloat(Session::get('grandTotal')),
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);

                    //  Insert Orders Products
                    foreach($cart as $item) {
                        $details = json_decode($item['details'], true, 512, JSON_THROW_ON_ERROR);
                        $finalPrice = Cart::getVariationPrice($item['product_id'], $details)['discount_price'];

                        $ordersProduct = new OrdersProduct;
                        $ordersProduct->order_id = $orderId;
                        $ordersProduct->product_id = $item['product_id'];
                        $ordersProduct->details = $item['details'];
                        $ordersProduct->quantity = $item['quantity'];
                        $ordersProduct->final_unit_price = $finalPrice;

                        $ordersProduct->save();
                    }

                    //  Add orderId to session
                    Session::put('orderId', $orderId);

                    $order = Order::findOrFail($orderId);
                    Mail::to(Auth::user()->email)->queue(new OrderPlaced($order));
                });
            } catch (Exception $e) {
                $message = "Unable to place order! Please contact @Lè_•Çapuchôn✓🩸";
                return back()->with('alert', ['type' => 'danger', 'intro' => 'Warning!', 'message' => $message, 'duration' => 7]);
            }

            //  Return Success
            $message = "Your Order has been Placed ! 🥳 You shall receive an email shortly.";
            return redirect('/thank-you')->with('alert', ['type' => 'success', 'intro' => 'Great!', 'message' => $message, 'duration' => 7]);
        }

        return accessDenied();
    }

    public function thankYou(): View|Factory|Redirector|RedirectResponse|Application
    {
        if(session::has('orderId')) {
            //  Empty User Cart
            Cart::where('user_id', Auth::id())->delete();

            return view('thanks');
        }

        return redirect('/cart');
    }



    public function printInvoicePDF($id): Factory|View|Application {
        $order = Order::where('id', $id)->with('orderProducts', 'user', 'address', 'phone')->first()->toArray();

        $html = view('Admin.invoice_template')->with(compact('order'))->render();

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

        return view('Admin.invoice')->with(compact('order'));
    }
}