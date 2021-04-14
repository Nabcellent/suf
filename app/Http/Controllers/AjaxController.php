<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCounty;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
}
