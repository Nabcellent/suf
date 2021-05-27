<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Phone;
use App\Models\Product;
use App\Models\SubCounty;
use App\Models\User;
use App\Models\Variation;
use App\Models\VariationsOption;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    public function getFilteredProducts(Request $request): JsonResponse {
        if($request->ajax()) {
            $data = $request->all();
            $query = Product::products()->where('products.status', 1)
                ->join('categories', 'products.category_id', 'categories.id')
                ->select('products.*');

            if(isset($data['categoryId'])) {
                $catDetails = Category::categoryDetails($data['categoryId']);
                $query->whereIn('products.category_id', $catDetails['catIds']);
            }

            if($request->has('category')) { $query->whereIn('categories.category_id', $data['category']); }
            if($request->has('subCategory')) { $query->whereIn('products.category_id', $data['subCategory']); }
            if($request->has('seller')) { $query->whereIn('products.seller_id', $data['seller']); }
            if($request->has('brand')) { $query->whereIn('products.brand_id', $data['brand']); }

            if(isset($_GET['sort']) && !empty($_GET['sort'])) {
                if($_GET['sort'] === "newest") {
                    $query->orderByDesc('products.id');
                } elseif($_GET['sort'] === "oldest") {
                    $query->orderBy('products.id');
                } elseif($_GET['sort'] === "title_asc") {
                    $query->orderBy('products.title');
                } elseif($_GET['sort'] === "title_desc") {
                    $query->orderByDesc('products.title');
                } elseif($_GET['sort'] === "price_asc") {
                    $query->orderBy('products.base_price');
                } elseif($_GET['sort'] === "price_desc") {
                    $query->orderByDesc('products.base_price');
                }
            }

            $products = $query->paginate($data['perPage']);

            return response()->json([
                'view' => (string)view('partials.products.products_data', compact('products')),
                'count' => count($products)
            ]);
        }

        return response()->json([404]);
    }
    public function getSubCountyById(Request $req): JsonResponse
    {
        if($req->ajax()) {
            $id = $req->id;

            $subCounties = SubCounty::where(['county_id' => $id, 'status' => 1])->orderBy('name')->get(['id', 'name'])->toArray();

            if($req->has('subCounty')) {
                $options = '';
                $subCountyId = $req->subCounty;

                if(is_numeric($subCountyId)) {
                    foreach($subCounties as $subCounty) {
                        $selected = ((int)$subCountyId === $subCounty['id']) ? 'selected' : '';
                        $options .= '<option value="' . $subCounty["id"] . '" ' . $selected . '>' . $subCounty["name"] . '</option>';
                    }
                }
            } else {
                $options = '<option selected hidden value="">Select your Sub-county *</option>';
                foreach($subCounties as $subCounty) {
                    $options .= '<option value="' . $subCounty["id"] . '">' . $subCounty["name"] . '</option>';
                }
            }

            return response()->json(['subCounties' => $options, 200]);
        }

        return response()->json([404]);
    }



    /**
     * ---------------------------------------------------------------------------------------------    DATABASE CHECKS
     */

    public function checkCurrentPassword(Request $req): Redirector|string|Application|RedirectResponse {
        if($req->ajax()) {
            if(Hash::check($req->current_password, Auth::user()['password'])) {
                return "true";
            }

            return "false";
        }

        return "false";
    }

    public function checkEmailExists(Request $req): string
    {
        $exists = User::where('email', $req->email)->exists();

        return $exists ? "false" : "true";
    }

    public function checkUsernameExists(Request $req): string
    {
        $exists = Admin::where('username', $req->username);
        if(Auth::check()) {
            $exists = $exists->where('user_id', '<>', Auth::id());
        }
        $exists = $exists->exists();

        return $exists ? "false" : "true";
    }

    public function checkNationalIdExists(Request $req): string
    {
        $exists = Admin::where('national_id', $req->national_id);
        if(Auth::check()) {
            $exists = $exists->where('user_id', '<>', Auth::id());
        }
        $exists = $exists->exists();

        return $exists ? "false" : "true";
    }

    public function checkPhoneExists(Request $req): string
    {
        $phone = $req -> phone;
        $phone = Str::length($phone) > 9 ? Str::substr($phone, -9) : $phone;

        $check = Phone::where('phone', $phone);

        if(Auth::check()) {
            $check->where('user_id', '<>', Auth::id());
        }

        $exists = $check->exists();

        return $exists ? "false" : "true";
    }

    public function checkVariationExists(Request $request): string
    {
        $attribute = Attribute::find($request->attribute)->name;
        $variations = Variation::where('product_id', $request->productId);

        if($variations->exists()) {
            $variations = $variations->pluck('variation')->toArray();
            foreach($variations as $variation) {
                if(key(json_decode($variation, true, 512, JSON_THROW_ON_ERROR)) === $attribute) {
                    return "false";
                }
            }
        }

        return "true";
    }

    public function checkVariationOptionExists(Request $request): string
    {
        $exists = VariationsOption::where([
            'variation_id' => $request->variationId,
            'variant' => $request->variant
        ])->exists();

        return $exists ? "false" : "true";
    }
}
