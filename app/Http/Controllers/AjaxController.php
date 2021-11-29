<?php

namespace App\Http\Controllers;

use App\Models\{Admin, Category, Phone, Product, SubCounty, User, Variation};
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
    public function getFilteredProducts(Request $request): JsonResponse {
        if($request->ajax()) {
            $data = $request->all();

            $priceString = 'products.base_price - (products.base_price * (products.discount / 100))';
            $query = Product::with('subCategory', 'brand', 'seller')->where('products.status', 1)
                ->whereRaw("$priceString >= {$data['priceRange'][0]}")
                ->whereRaw("$priceString <= {$data['priceRange'][1]}")
                ->join('categories', 'products.category_id', 'categories.id')->select('products.*');

            if(isset($data['categoryId'])) {
                $catDetails = Category::categoryDetails($data['categoryId']);
                $query->whereIn('products.category_id', $catDetails['catIds']);
            }

            if($request->has('category')) $query->whereIn('categories.category_id', $data['category']);
            if($request->has('subCategory')) $query->whereIn('products.category_id', $data['subCategory']);
            if($request->has('seller')) $query->whereIn('products.seller_id', $data['seller']);
            if($request->has('brand')) $query->whereIn('products.brand_id', $data['brand']);

            if(isset($_GET['sort']) && !empty($_GET['sort'])) {
                if($_GET['sort'] === "newest") {
                    $query->orderByDesc('products.id');
                } else if($_GET['sort'] === "oldest") {
                    $query->orderBy('products.id');
                } else if($_GET['sort'] === "title_asc") {
                    $query->orderBy('products.title');
                } else if($_GET['sort'] === "title_desc") {
                    $query->orderByDesc('products.title');
                } else if($_GET['sort'] === "price_asc") {
                    $query->orderByRaw($priceString);
                } else if($_GET['sort'] === "price_desc") {
                    $query->orderByRaw("$priceString DESC");
                }
            }

            $products = $query->paginate($data['perPage']);

            return response()->json([
                'view'  => (string)view('partials.products.products_data', compact('products')),
                'count' => count($products)
            ]);
        }

        return response()->json([404]);
    }

    public function getSubCountyById(Request $request): JsonResponse {
        if($request->ajax()) {
            $id = $request->input('id');

            $subCounties = SubCounty::where(['county_id' => $id, 'status' => 1])->orderBy('name')->get(['id', 'name'])
                ->toArray();

            if($request->has('subCounty')) {
                $options = '';
                $subCountyId = $request->input('subCounty');

                if(is_numeric($subCountyId)) {
                    foreach($subCounties as $subCounty) {
                        $selected = ((int)$subCountyId === $subCounty['id'])
                            ? 'selected'
                            : '';
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

    public function checkCurrentPassword(Request $request): Redirector|string|Application|RedirectResponse {
        if(Hash::check($request->input('current_password'), Auth::user()['password'])) {
            return "true";
        }

        return "false";
    }

    public function checkEmailExists(Request $request): string {
        $exists = User::where('email', $request->input('email'))->exists();

        return $exists
            ? "false"
            : "true";
    }

    public function checkUsernameExists(Request $request): string {
        $exists = Admin::where('username', $request->input('username'));
        if(Auth::check()) {
            $exists = $exists->where('user_id', '<>', Auth::id());
        }
        $exists = $exists->exists();

        return $exists
            ? "false"
            : "true";
    }

    public function checkPhoneExists(Request $request): string {
        $phone = $request->input('phone');
        $phone = Str::length($phone) > 9
            ? Str::substr($phone, -9)
            : $phone;

        $check = Phone::where('phone', $phone);

        if(Auth::check()) {
            $check->where('user_id', '<>', Auth::id());
        }

        $exists = $check->exists();

        return $exists
            ? "false"
            : "true";
    }

    public function checkVariationExists(Request $request): string {
        $exists = Variation::where([
            'product_id'   => $request->input('productId'),
            'attribute_id' => $request->input('attribute')
        ])->exists();

        return $exists
            ? "false"
            : "true";
    }

    public function checkVariationOptionExists(Request $request): string {
        $variation = Variation::findOrFail($request->input('variationId'));
        $exists = Arr::exists($variation->options, $request->input('variant'));

        return $exists
            ? "false"
            : "true";
    }
}
