<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        //  Get Featured Products
        $featuredProducts = Product::products()->where('products.status', 1)
            ->where('is_featured', 'Yes')->has('variations')->get()->toArray();

        //  Get Latest Products
        $new = Product::join('admins', 'admins.user_id', 'seller_id')
            ->select('products.*', 'admins.username', 'section.title AS section')
            ->join('categories AS cat', 'products.category_id', '=', 'cat.id')
            ->join('categories AS section', 'cat.section_id', '=', 'section.id')
            ->where(['products.status' => 1])->has('variations')->orderByDesc('products.id')->limit(12)->get()->toArray();

        //  Get Top Products
        $topProducts = Product::where('status', 1)->has('variations')->orderByDesc('id')->limit(10)->get()->shuffle()->toArray();

        //  Get banners & Ad boxes
        $banners = Banner::getBanners();

        return View('home')
            ->with(compact('banners', 'featuredProducts', 'topProducts', 'new'));
    }
}
