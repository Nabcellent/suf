<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Brand;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function showAttributes(): Factory|View|Application {
        $attributes = Attribute::latest()->get()->toArray();
        $brands = Brand::latest()->withCount('products')->get()->toArray();

        return view('Admin.products.attributes')
            ->with(compact('attributes', 'brands'));
    }
}
