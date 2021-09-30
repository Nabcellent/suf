<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Aid;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Brand;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class AttributeController extends Controller {
    public function index(): Factory|View|Application {
        $attributes = Attribute::latest()->get();
        $brands = Brand::latest()->withCount('products')->get();

        return view('admin.products.attributes')
            ->with(compact('attributes', 'brands'));
    }

    public function upsertAttribute(Request $request) {
        Attribute::updateOrCreate(['name' => $request->input('name')], $request->all());

        return Aid::createOk('Success...!');
    }

    public function upsertBrand(Request $request): RedirectResponse {
        try {
            $title = DB::transaction(function() use ($request) {
                if($request->input('brand_id')) {
                    Brand::where('id', $request->input('brand_id'))->update(['name' => $request->input('name')]);
                    return "Updated";
                }

                Brand::create($request->all());
                return "Created";
            });

            $message = "Brand $title.";
            return back()->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
        } catch(Throwable $e) {
            return Aid::returnToastError($e->getMessage(), 'Error...');
        }
    }
}
