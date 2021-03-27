<?php

namespace App\Http\Controllers;

use App\Models\AdBox;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    //
    function index() {
        $homeInfo = [
            'slider' => Slider::all(),
            'adBoxes' => AdBox::all(),
            'products' => [
                'latestGents' => Product::where('category_id', 1) ->orderByDesc('id') -> take(10) -> get(),
                'latestLadies' => Product::join('categories', '',),
                //'latestLadies' => Product::where('category_id', 2) ->orderByDesc('id') -> take(10) -> get(),
                'top' => Product::orderByDesc('id') -> take(10) -> get(),
                'subCategories' => DB::table('products')
                    -> join('categories', 'products.category_id', '=', 'categories.id')
                    -> select('categories.title',) -> orderBy('categories.title', 'ASC')
                    -> distinct() -> get()
            ],
        ];

        return View('index', compact('homeInfo'));
    }
}
