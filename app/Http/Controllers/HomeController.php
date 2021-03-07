<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Product;
use App\Models\Slider;
use App\Models\AdBox;

class HomeController extends Controller
{
    //
    function index() {
        $homeInfo = [
            'slider' => Slider::all(),
            'adBoxes' => AdBox::all(),
            'products' => [
                'latestGents' => Product::where('cat_id', 1) ->orderByDesc('id') -> take(10) -> get(),
                'latestLadies' => Product::where('cat_id', 2) ->orderByDesc('id') -> take(10) -> get(),
                'top' => Product::orderByDesc('id') -> take(10) -> get(),
                'subCategories' => DB::table('products')
                    -> join('sub_categories', 'products.subcat_id', '=', 'sub_categories.subcat_id')
                    -> join('categories', 'products.cat_id', '=', 'categories.cat_id')
                    -> select('subcat_title', 'cat_title') -> orderBy('subcat_title', 'ASC')
                    -> distinct() -> get()
            ],
        ];

        return View('index', compact('homeInfo'));
    }
}
