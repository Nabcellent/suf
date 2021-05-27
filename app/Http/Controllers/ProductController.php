<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Variation;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use JsonException;

class ProductController extends Controller
{
    public function index($categoryId = null): View|Factory|string|Application
    {
        $products = Product::products()->where('products.status', 1);

        $catDetails = "";
        if($categoryId !== null) {
            $categoryCount = Category::where(['id' => $categoryId, 'status' => 1])->count();

            if($categoryCount > 0) {
                $catDetails = Category::categoryDetails($categoryId);
                $products->whereIn('products.category_id', $catDetails['catIds']);
            }
        }

        $products = $products->paginate(10);

        $sellers = Admin::getSellers()->get()->toArray();
        $brands = Brand::brands()->get()->toArray();

        return View('products')
            ->with(compact('products', 'sellers', 'brands', 'catDetails'));
    }

    public function showDetails($id): Factory|View|Application
    {
        app('redirect')->setIntendedUrl(URL::previous());

        $details = Product::with(['subCategory', 'brand', 'seller', 'variations' => function($query) {
            $query->where('status', 1);
        }, 'images'])
            ->find($id)->toArray();
        $totalStock = Variation::join('variations_options', 'variations.id', 'variations_options.variation_id')
            ->where(['product_id' => $id, 'variations.status' => 1, 'variations_options.status' => 1])->min('stock');
        $related = Product::with('brand')->where('category_id', $details['sub_category']['id'])
            ->where('id', '!=', $id)->inRandomOrder()->limit(5)->get()->toArray();

        return view('details')->with(compact('details', 'totalStock', 'related'));
    }

    //  VIA - AJAX
    public function getProductPrice(Request $req): ?array
    {
        if($req->ajax()) {
            $data = $req->all();
            $productId = (int)$data['productId'];

            $basePrice = Product::where('id', $productId)->value('base_price');
            $extraPrice = Variation::join('variations_options', 'variations.id', 'variations_options.variation_id')
                ->whereIn('variant', $data['variations'])
                ->where('product_id', $productId)->sum('extra_price');

            $newPrice = $basePrice + $extraPrice;

            return Product::getVariationDiscountPrice($productId, $newPrice);
        }

        return null;
    }

    public function storeCart(Request $req): Redirector|RedirectResponse|Application {
        $data = $req->all();

        $details = array();
        foreach($data as $key => $value) {
            if(str::startsWith($key, 'variant')) {
                $variant = Str::of(substr($key, 7))->singular()->jsonSerialize();
                $details = Arr::add($details, $variant, $value);
            }
        }

        if(count($details) > 0) {
            //check if stock is available
            $productStock = Variation::join('variations_options', 'variations.id', 'variations_options.variation_id')
                ->where('product_id', $data['product_id'])
                ->whereIn('variant', $details)->min('stock');

            if($productStock < $data['quantity']) {
                $message = "That quantity is not available for this combination🤧";
                return back()->withInput()
                    ->with('alert', ['type' => 'danger', 'intro' => 'Sorryy!', 'message' => $message, 'duration' => 7]);
            }
        }

        //  Generate Session ID if not exists
        $sessionId = Session::get('session_id');
        if(empty($sessionId)) {
            $sessionId = Session::getId();
            Session::put('session_id', $sessionId);
        }

        //  Check if Similar Product already exists
        $countProducts = Cart::where('product_id', $data['product_id'])->whereJsonContains('details', $details);
        $countProducts = (Auth::check()) ? $countProducts->where('user_id', Auth::id()) : $countProducts->where('session_id', $sessionId);
        $countProducts = $countProducts->count();

        if($countProducts > 0) {
            $message = "Product already exists in Cart😁";
            return back()->withInput()
                ->with('alert', ['type' => 'info', 'intro' => 'Oops!', 'message' => $message, 'duration' => 7]);
        }

        //  Convert Details to JSON for storage
        try {
            $details = json_encode($details, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            $message = "Something went wrong🤧";
            return back()->with('alert', alert('danger', '💔!', $message, 7));
        }

        $store = [
            'user_id' => (Auth::check()) ? Auth::id() : null,
            'session_id' => $sessionId,
            'product_id' => $data['product_id'],
            'details' => $details,
            'quantity' => $data['quantity'],
        ];

        Cart::create($store);

        $message = "Item Added to Cart!";
        $link = ['title' => 'View', 'url' => route('cart')];
        return redirect()->intended()->with('alert', alert('success', 'Nice!', $message, 10, $link));
    }

    public function cart(): View|Factory|Redirector|RedirectResponse|Application
    {
        $cart = Cart::cartItems();

        return view('cart', compact('cart'));
    }

    /**
     * @throws JsonException
     */
    public function updateCartItemQty(Request $req): JsonResponse|Redirector|RedirectResponse|Application
    {
        if($req->ajax()) {
            $data = $req->all();
            $cartId = $data['cartId'];
            $demandedQty = $data['newQty'];

            $cartItem = Cart::find($cartId);
            $details = json_decode($cartItem['details'], true, 512, JSON_THROW_ON_ERROR);

            //check if stock is available
            $availableStock = Variation::checkVariations($cartItem['product_id'], $details)->select('stock')->min('stock');
            $inactiveStatus = Variation::checkVariations($cartItem['product_id'], $details)
                ->select('variations_options.status')->where('variations_options.status', 0)->exists();


            if($inactiveStatus) {
                $variant = Variation::checkVariations($cartItem['product_id'], $details)
                    ->where('variations_options.status', 0)->value('variant');
                $cart = Cart::cartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Variation, "' . ($variant) . '" is currently unavailable for this product. ☹',
                    'view' => (string)view('partials.products.cart-table', compact('cart'))
                ]);
            }

            if($availableStock < $demandedQty) {
                $cart = Cart::cartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'The current stock for this product is insufficient. 😢',
                    'view' => (string)view('partials.products.cart-table', compact('cart'))
                ]);
            }

            $cartItem->quantity = $demandedQty;
            $cartItem->save();

            $cart = Cart::cartItems();
            return response()->json([
                'status' => true,
                'cartCount'=> cartCount(),
                'cartTotal'=> cartTotal(),
                'view' => (string)view('partials.products.cart-table', compact('cart'))
            ]);
        }

        return accessDenied();
    }

    public function deleteCartItem(Request $req): JsonResponse|Redirector|RedirectResponse|Application
    {
        if($req->ajax()) {
            Cart::destroy($req->cartId);

            if(!(cartCount() > 0) && Session::has('couponId')) {
                Session ::forget(['couponDiscount', 'couponId', 'grandTotal']);
            }

            $cart = Cart::cartItems();
            return response()->json([
                'status' => true,
                'cartCount'=> cartCount(),
                'cartTotal'=> cartTotal(),
                'view' => (string)view('partials.products.cart-table', compact('cart'))
            ]);
        }

        return accessDenied();
    }
}
