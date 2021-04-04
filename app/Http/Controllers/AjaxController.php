<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getProducts(Request $req): string
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

            $products = $query->orderByDesc('products.id')->paginate($data['perPage']);

            //echo "<pre>"; print_r($products); die;
            return view('partials.products.products_data', compact('products'))->render();
        }
    }
}
