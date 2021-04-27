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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AjaxController extends Controller
{
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

    public function checkCurrentPassword(Request $req): bool
    {
        if($req->ajax() && $req->isMethod('POST')) {
            if(Hash::check($req->current_password, Auth::user()['password'])) {
                return true;
            }

            return false;
        }

        return false;
    }

    public function checkEmailExists(Request $req): string
    {
        //  Check if email exists
        $exists = User::where('email', $req->email)->exists();

        return $exists ? "false" : "true";
    }

    public function checkUsernameExists(Request $req): string
    {
        //  Check if email exists
        $exists = Admin::where('username', $req->username)->exists();

        return $exists ? "false" : "true";
    }

    public function checkNationalIdExists(Request $req): string
    {
        //  Check if email exists
        $exists = Admin::where('national_id', $req->national_id)->exists();

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
