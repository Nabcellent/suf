<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Brand;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    public function showAttributes(): Factory|View|Application {
        $attributes = Attribute::latest()->get()->toArray();
        $brands = Brand::latest()->withCount('products')->get()->toArray();

        return view('Admin.products.attributes')
            ->with(compact('attributes', 'brands'));
    }

    public function createUpdateBrand(Request $request): RedirectResponse {
        $title = DB::transaction(function() use ($request) {
            if($request->brand_id) {
                Brand::where('id', $request->brand_id)->update(['name' => $request->name]);
                return "Updated";
            }

            Brand::create($request->all());
            return "Created";
        });

        $message = "Brand $title.";
        return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }
}
