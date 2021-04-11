<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Seller;
use App\Models\Variation;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use JsonException;

class ProductController extends Controller
{
    public function index(Request $req): View|Factory|string|Application
    {
        if($req->ajax()) {
            $data = $req->all();
            $query = Product::products()->where('products.status', 1)
                ->join('categories', 'products.category_id', 'categories.id')
                ->select('products.*');

            if(isset($data['categoryId'])) {
                $catDetails = Category::categoryDetails($data['categoryId']);
                $query->whereIn('products.category_id', $catDetails['catIds']);
            }

            if($req->has('category')) {
                $query->whereIn('categories.category_id', $data['category']);
            }
            if($req->has('subCategory')) {
                $query->whereIn('products.category_id', $data['subCategory']);
            }
            if($req->has('seller')) {
                $query->whereIn('products.seller_id', $data['seller']);
            }
            if($req->has('brand')) {
                $query->whereIn('products.brand_id', $data['brand']);
            }

            if(isset($_GET['sort']) && !empty($_GET['sort'])) {
                if($_GET['sort'] === "newest") {
                    $query->orderByDesc('products.id');
                } elseif($_GET['sort'] === "oldest") {
                    $query->orderBy('products.id');
                } elseif($_GET['sort'] === "title_asc") {
                    $query->orderBy('products.title');
                } elseif($_GET['sort'] === "title_desc") {
                    $query->orderByDesc('products.title');
                } elseif($_GET['sort'] === "price_asc") {
                    $query->orderBy('products.base_price');
                } elseif($_GET['sort'] === "price_desc") {
                    $query->orderByDesc('products.base_price');
                }
            }

            $products = $query->paginate($data['perPage']);

            return view('partials.products.products_data', compact('products'));
        }

        $categoryId = Route::getFacadeRoot()->current()->uri();
        $categoryId = substr($categoryId, 9);
        $categoryCount = Category::where(['id' => $categoryId, 'status' => 1])->count();

        $productCount = Product::products()->where('products.status', 1)->count();
        $products = Product::products()->where('products.status', 1);

        $catDetails = null;
        if($categoryId !== null && $categoryCount > 0) {
            $catDetails = Category::categoryDetails($categoryId);
            $products->whereIn('products.category_id', $catDetails['catIds']);
        }

        $products = $products->paginate(10);

        $sellers = Seller::sellers()->get()->toArray();
        $brands = Brand::brands()->get()->toArray();

        //echo "<pre>"; print_r($catDetails); die;
        return View('products')
            ->with(compact('products', 'sellers', 'brands', 'catDetails'))
            ->with(compact('productCount'));
    }

    public function details($id): Factory|View|Application
    {
        $details = Product::with(['category', 'brand', 'seller', 'variations' => function($query) {
            $query->where('status', 1);
        }, 'images'])
            ->find($id)->toArray();
        $totalStock = Variation::join('variations_options', 'variations.id', 'variations_options.variation_id')
            ->where(['product_id' => $id, 'variations.status' => 1, 'variations_options.status' => 1])->sum('stock');
        $related = Product::with('brand')->where('category_id', $details['category']['id'])
            ->where('id', '!=', $id)->inRandomOrder()->limit(5)->get()->toArray();

        return view('details')->with(compact('details', 'totalStock', 'related'));
    }

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

    public function addToCart(Request $req): Redirector|RedirectResponse|Application
    {
        if($req->isMethod('POST')) {
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
                    $message = "Required quantity is not available for this combination🤧";
                    return back()->with('alert', ['type' => 'danger', 'intro' => 'Oops!', 'message' => $message, 'duration' => 7]);
                }
            }

            //  Generate Session ID if not exists
            $sessionId = Session::get('session_id');
            if(empty($sessionId)) {
                $sessionId = Session::getId();
                Session::put('session_id', $sessionId);
            }

            //  Check if Similar Product already exists
            if(Auth::check()) {
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'user_id' => Auth::id()])->whereJsonContains('details', $details)->count();
            } else {
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'session_id' => $sessionId])->whereJsonContains('details', $details)->count();
            }
            if($countProducts > 0) {
                $message = "Product already exists in Cart😁";
                return back()->with('alert', ['type' => 'info', 'intro' => 'Oops!', 'message' => $message, 'duration' => 7]);
            }

            //  Convert Details to JSON for storage
            try {
                $details = json_encode($details, JSON_THROW_ON_ERROR);
            } catch (JsonException $e) {
                $message = "Something went wrong🤧";
                return back()->with('alert', ['type' => 'danger', 'intro' => '💔!', 'message' => $message, 'duration' => 7]);
            }

            //  Save to Cart Table
            $cart = new Cart;
            $cart -> user_id = (Auth::check()) ? Auth::id() : null;
            $cart -> session_id = $sessionId;
            $cart -> product_id = $data['product_id'];
            $cart -> details = $details;
            $cart -> quantity = $data['quantity'];
            $cart -> created_at = Carbon::now();
            $cart -> updated_at = Carbon::now();
            $cart -> save();
        }

        $message = "Item Added to Cart!";
        return redirect('/cart')->with('alert', [
            'type' => 'success',
            'intro' => 'Success! ',
            'message' => $message,
            'duration' => 7
        ]);
    }

    public function cart(): View|Factory|Redirector|RedirectResponse|Application
    {
        $cart = Cart::cartItems();

        //dd($cart);
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
                'view' => (string)view('partials.products.cart-table', compact('cart'))
            ]);
        }

        $message = "Access Denied!";
        return redirect('/')->with('alert', ['type' => 'danger', 'intro' => 'Sorry!', 'message' => $message, 'duration' => 7]);
    }

    public function deleteCartItem(Request $req): JsonResponse|Redirector|RedirectResponse|Application
    {
        if($req->ajax()) {
            Cart::destroy($req->cartId);

            $cart = Cart::cartItems();
            return response()->json([
                'status' => true,
                'view' => (string)view('partials.products.cart-table', compact('cart'))
            ]);
        }

        $message = "Access Denied!";
        return redirect('/')->with('alert', ['type' => 'danger', 'intro' => 'Sorry!', 'message' => $message, 'duration' => 7]);
    }
}
