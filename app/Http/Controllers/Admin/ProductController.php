<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProducts(): Factory|View|Application {
        $products = Product::with('seller')->orderByDesc('id')->get()->toArray();

        return view('Admin.products.list')
            ->with(compact('products'));
    }

    public function showProduct($id): Factory|View|Application {
        $product = Product::productDetails($id)->first()->toArray();
        //dd(Product::latest('id')->value('id'));

        return view('Admin.products.view')
            ->with(compact('product'));
    }

    public function getCreateProduct(): Factory|View|Application {
        $products = Product::with('seller')->get()->toArray();

        return view('Admin.products.create')
            ->with(compact('products'));
    }
}
