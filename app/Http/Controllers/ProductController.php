<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
    //
    public function index(): Application|Factory|View
    {
        $sidebarInfo = [
            'subCategories' => DB::table('products')
                -> select('categories.*') -> distinct()
                -> join('categories', function($join) {
                    $join -> on('products.category_id', '=', 'categories.id');
                }) -> get(),
            'sellers' => DB::table('products')
                -> select('sellers.*') -> distinct()
                -> join('sellers', function($join) {
                    $join -> on('products.seller_id', '=', 'sellers.user_id');
                }) -> get(),
            'categories' => DB::table('products')
                -> select('cat.title') -> distinct()
                -> join('categories as subCat', function($join) {
                    $join -> on('products.category_id', '=', 'subCat.id');
                }) -> join('categories as cat', function($join) {
                    $join -> on('subCat.category_id', '=', 'cat.id');
                }) -> get()
        ];

        $products = Product::join('sellers', 'products.seller_id', '=', 'sellers.user_id')
            -> get();

        return View('products', compact('products', 'sidebarInfo'));
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

    public function listing($url): void
    {
        $categoryCount = Category::where('url', $url)->count();

        if($categoryCount > 0) {
            echo "Category exists"; die;
        }

        abort(404);
    }
}
