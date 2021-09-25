<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

use App\Models\{Product, Cart, Brand, Admin, Category, Variation};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Throwable;

class ProductController extends Controller
{
    public function index($categoryId = null): View|Factory|string|Application {
        $products = Product::products()->where('products.status', 1);

        $catDetails = "";
        if($categoryId !== null) {
            $categoryCount = Category::where(['id' => $categoryId, 'status' => 1])->count();

            if($categoryCount > 0) {
                $catDetails = Category::categoryDetails($categoryId);
                $products->whereIn('products.category_id', $catDetails['catIds']);
            }
        }

        $data = [
            'products' => $products->paginate(10),
            'sellers' => Admin::getSellers()->get(),
            'brands' => Brand::brands()->get(),
            'catDetails' => $catDetails,
            'minPrice' => ceil($products->min('base_price')),
            'maxPrice' => floor($products->max('base_price')),
        ];

        return View('products', $data);
    }

    public function showDetails($id): Factory|View|Application {
        $data['details'] = Product::with(['subCategory', 'brand', 'seller', 'variations' => function($query) {
            $query->where('status', 1);
        }, 'images'])->find($id);

        $attributes = $data['details']->variations->pluck('options')->collapse()->keys()->toArray();

        $data['totalStock'] = Product::stock($id, "sum", $attributes);
        $data['related'] = Product::with('brand')->where('category_id', $data['details']->subCategory->id)
            ->where('id', '!=', $id)->inRandomOrder()->limit(5)->get();

        $data['metaDesc'] = $data['details']->description;
        $data['metaKeywords'] = $data['details']->keywords;

        return view('details', $data);
    }

    //  VIA - AJAX
    public function getProductPrice(Request $request): ?array {
        if($request->ajax()) {
            $data = $request->all();
            $productId = $data['productId'];

            $basePrice = Product::where('id', $productId)->value('base_price');
            $extraPrice = Variation::where('product_id', $productId)->pluck('options')
                ->collapse()->filter(function($value, $key) use($data) {
                    return in_array($key, $data['variations']);
                })->sum('extra_price');

            $newPrice = $basePrice + $extraPrice;

            return Product::getVariationDiscountPrice($productId, $newPrice);
        }

        return null;
    }

    public function storeCart(Request $request): Redirector|RedirectResponse|Application {
        $data = $request->all();

        $details = array();
        foreach($data as $key => $value) {
            if(str::startsWith($key, 'variant')) {
                $variant = Str::of(substr($key, 7))->singular()->jsonSerialize();
                $details[$variant] = $value;
            }
        }

        if(count($details) > 0) {
            //check if stock is available
            $availableStock = Product::stock($data['product_id'], "min", $details);

            if($availableStock < $data['quantity']) {
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
        $countProducts = (Auth::check())
            ? $countProducts->where('user_id', Auth::id())
            : $countProducts->where('session_id', $sessionId);

        if($countProducts->exists()) {
            $message = "Product already exists in Cart😁";
            return back()->withInput()
                ->with('alert', ['type' => 'info', 'intro' => 'Oops!', 'message' => $message, 'duration' => 7]);
        }

        //  Convert Details to JSON for storage
        try {
            DB::transaction(function() use($sessionId, $data, $details) {
                Cart::create([
                    'user_id' => (Auth::check()) ? Auth::id() : null,
                    'session_id' => $sessionId,
                    'product_id' => $data['product_id'],
                    'details' => $details,
                    'quantity' => $data['quantity'] === 0 ? 1 : $data['quantity'] ,
                ]);
            });

            setCartItems();

            $message = "Item Added to Cart!";
            $link = ['title' => 'View', 'url' => route('cart')];

            return redirect()->route('products')
                ->with('alert', alert('success', 'Nice!', $message, 10, $link));
        } catch (Exception | Throwable $e) {
            Log::error($e->getMessage());
            return back()->with('alert', alert('danger', '💔!', "Something went wrong🤧", 7));
        }
    }

    public function cart(): View|Factory|Redirector|RedirectResponse|Application {
        $data = [
            'cart' => Cart::cartItems(),
            'metaDesc' => 'SuF store Shopping cart',
            'metaKeywords' => 'Su-F Cart, shopping cart, store cart, fashion store shopping cart, suf cart, Ecommerce website, online store'
        ];

        return view('cart', $data);
    }

    /**
     * @throws Exception
     */
    public function updateCartItemQty(Request $request): JsonResponse|Redirector|RedirectResponse|Application {
        if($request->ajax()) {
            $data = $request->all();
            $cartId = $data['cartId'];
            $demandedQty = $data['newQty'];

            $cartItem = Cart::find($cartId);
            $details = json_decode($cartItem['details'], true, 512, JSON_THROW_ON_ERROR);

            //check if stock is available
            $availableStock = Variation::checkVariations($cartItem['product_id'], $details)
                ->select('stock')->min('stock');
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
                'cartCount'=> getCart('count'),
                'cartTotal'=> getCart('total'),
                'view' => (string)view('partials.products.cart-table', compact('cart'))
            ]);
        }

        return accessDenied();
    }

    public function deleteCartItem(Request $request): JsonResponse|Redirector|RedirectResponse|Application
    {
        if($request->ajax()) {
            Cart::destroy($request->input('cartId'));

            if(!(getCart('count') > 0) && Session::has('couponId')) {
                Session ::forget(['couponDiscount', 'couponId', 'grandTotal']);
            }

            setCartItems();
            $cart = Cart::cartItems();
            return response()->json([
                'status' => true,
                'cartCount'=> getCart('count'),
                'cartTotal'=> getCart('total'),
                'view' => (string)view('partials.products.cart-table', compact('cart'))
            ]);
        }

        return accessDenied();
    }
}
