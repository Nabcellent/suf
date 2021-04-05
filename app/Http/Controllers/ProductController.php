<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Seller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Cart;

class ProductController extends Controller
{
    public function index(Request $req, $categoryId = null): View|Factory|string|Application
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






    public function productDetails($id): Application
    {
        $details = [
            'details' => Product::find($id),
            'products' => Product::join('manufacturers', 'products.man_id', '=', 'manufacturers.man_id')
                -> get() -> shuffle()
        ];

        return view('details', compact('details'));
    }

    public function cart(): View|Factory|Redirector|RedirectResponse|Application
    {
        if(!Auth::check()) {
            return redirect('/sign-in');
        }

        $cart = [
            'cart' => Cart::join('products', 'cart.product_id', '=', 'products.id')
                ->where('cart.user_id', '=', Auth::id())
                -> get(),
            'total' => Cart::select(DB::raw('sum(cart.quantity * cart.unit_price) AS total'))
                -> get(),
            'products' => Product::join('manufacturers', 'products.man_id', '=', 'manufacturers.man_id')
                -> get() -> shuffle()
        ];

        return view('cart', compact('cart'));
    }

    public function addToCart(Request $req): Redirector|RedirectResponse|Application
    {
        if(!Auth::check()) {
            return redirect('/sign-in');
        }

        $cart = new Cart;
        $cart -> product_id = $req -> product_id;
        $cart -> user_id = Auth::id();
        $cart -> quantity = $req -> quantity;
        $cart -> size = $req -> size;
        $cart -> unit_price = substr($req -> price, 0, -2);
        $cart -> save();

        return back();
    }
}
