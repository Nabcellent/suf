<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Cart;

class ProductController extends Controller
{
    //
    public function index(): Application|Factory|View
    {
        $products = Product::join('sellers', 'products.seller_id', '=', 'sellers.user_id')
            -> get();

        return View('products', compact('products'));
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

    public function cart(): View|Factory|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
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

    public function addToCart(Request $req): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
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
