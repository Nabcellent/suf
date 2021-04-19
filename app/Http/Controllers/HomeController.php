<?php

namespace App\Http\Controllers;

use App\Models\AdBox;
use App\Models\Banner;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        $pageTitle = "Index";
        //  Get Featured Products
        $featuredProductsCount = Product::where('is_featured', 'Yes')->where('products.status', 1)->has('variations')->count();
        $featuredProducts = Product::products()->where('products.status', 1)
            ->where('is_featured', 'Yes')->has('variations')->get()->toArray();

        //  Get Latest Products
        $newGentsProducts = Product::join('sellers', 'sellers.user_id', 'seller_id')
            ->select('products.*', 'sellers.username')
            ->join('categories AS cat', 'products.category_id', '=', 'cat.id')
            ->join('categories AS section', 'cat.section_id', '=', 'section.id')
            ->where(['section.title' => 'Gents', 'products.status' => 1])->has('variations')
            ->orderByDesc('products.id')->limit(10)->get()->toArray();
        $newLadiesProducts = Product::join('sellers', 'sellers.user_id', 'seller_id')
            ->select('products.*', 'sellers.username')
            ->join('categories AS cat', 'products.category_id', '=', 'cat.id')
            ->join('categories AS section', 'cat.section_id', '=', 'section.id')
            ->where(['section.title' => 'Ladies', 'products.status' => 1])->has('variations')
            ->orderByDesc('products.id')->limit(12)->get()->toArray();

        //  Get Top Products
        $topProducts = Product::where('status', 1)->has('variations')->orderByDesc('id')->limit(10)->get()->shuffle()->toArray();

        //  Get banners & Ad boxes
        $banners = Banner::getBanners();
        $adBoxes = AdBox::all();

        //dd($newGentsProducts);
        return View('index')
            ->with(compact('pageTitle','banners', 'adBoxes', 'featuredProducts', 'featuredProductsCount'))
            ->with(compact('newGentsProducts', 'newLadiesProducts', 'topProducts'));
    }
}
