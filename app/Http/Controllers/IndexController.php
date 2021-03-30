<?php

namespace App\Http\Controllers;

use App\Models\AdBox;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    public function index(): Factory|View|Application
    {
        //  Get Featured Products
        $featuredProductsCount = Product::where('is_featured', 'Yes')->where('products.status', 1)->count();
        $featuredProducts = Product::join('sellers', 'sellers.user_id', 'seller_id')
            ->where('is_featured', 'Yes')->where('status', 1)->get()->toArray();

        //  Get Latest Products
        $newGentsProducts = Product::join('sellers', 'sellers.user_id', 'seller_id')
            ->select('products.*', 'sellers.*')
            ->join('categories AS cat', 'products.category_id', '=', 'cat.id')
            ->join('categories AS section', 'cat.section_id', '=', 'section.id')
            ->where(['section.title' => 'Gents', 'products.status' => 1])
            ->orderByDesc('products.id')->limit(10)->get()->toArray();
        $newLadiesProducts = Product::join('sellers', 'sellers.user_id', 'seller_id')
            ->select('products.*', 'sellers.*')
            ->join('categories AS cat', 'products.category_id', '=', 'cat.id')
            ->join('categories AS section', 'cat.section_id', '=', 'section.id')
            ->where(['section.title' => 'Ladies', 'products.status' => 1])
            ->orderByDesc('products.id')->limit(12)->get()->toArray();

        //  Get Top Products
        $topProducts = Product::where('status', 1)->orderByDesc('id')->limit(10)->get()->shuffle()->toArray();

        $homeInfo = [
            'slider' => Slider::all(),
            'adBoxes' => AdBox::all()
        ];

        return View('index')
            ->with(compact('homeInfo', 'featuredProducts', 'featuredProductsCount'))
            ->with(compact('newGentsProducts', 'newLadiesProducts', 'topProducts'));
    }
}
