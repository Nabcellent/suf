<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use JsonException;

class AjaxController extends Controller
{
    public function getCategoriesBySectionId(Request $request): JsonResponse {
        $id = $request -> id;
        $categories = Category::where('section_id', $id)->whereNull('category_id')->get()->toArray();

        if($request->has('categoryId')) {
            $options = '';
            $categoryId = $request->categoryId;

            if(is_numeric($categoryId)) {
                foreach($categories as $category) {
                    $selected = ((int)$categoryId === $category['id']) ? 'selected' : '';
                    $options .= '<option value="' . $category["id"] . '" ' . $selected . '>' . $category["title"] . '</option>';
                }
            }
        } else {
            $options = '<option selected hidden value="">Select a category *</option>';
            foreach($categories as $category) {
                $options .= '<option value="' . $category['id'] . '">' . $category['title'] . '</option>';
            }
        }

        return response()->json(['categories' => $options, 200]);
    }

    public function getSubCategoriesByCategoryId(Request $request): JsonResponse {
        $id = $request -> id;
        $subCats = Category::where('category_id', $id)->get()->toArray();

        $result = '<option selected hidden value="">Select a sub-category *</option>';
        foreach($subCats as $subCat) {
            $result .= '<option value="' . $subCat['id'] . '">' . $subCat['title'] . '</option>';
        }

        return response()->json(['subCategories' => $result, 200]);
    }

    public function getAttributeValuesByAttrId(Request $request): JsonResponse {
        $id = $request -> id;
        $values = Attribute::find($id)->toArray();

        try {
            $values = json_decode($values['values'], true, 512, JSON_THROW_ON_ERROR);
        } catch(JsonException $e) {
            return response()->json(['error' => $e, 404]);
        }

        $result = '';
        if(is_array($values)) {
            foreach($values as $value) {
                $result .= '<option value="' . $value . '">' . $value . '</option>';
            }
        } else {
            $result .= '<option value="' . $values . '">' . $values . '</option>';
        }


        return response()->json(['values' => $result, 200]);
    }




    public function updateStatus(Request $request): JsonResponse {
        $data = $request->all();

        $table = getModel($data['model']);
        $model = $table::find($data['id']);
        $model->status = (Str::lower($data['status']) === "active") ? 0 : 1;
        $model->save();

        return response()->json(['status' => $model->status, 200]);
    }

    public function deleteFromTable($id, $model): JsonResponse {
        if($model === "Product's Image" || $model === "Product") {
            $imageName = getModel($model)::find($id)->image;
            if(File::exists(public_path('images/products/' . $imageName))){
                File::delete(public_path('images/products/' . $imageName));
            }
        } else if($model === "User") {
            $imageName = getModel($model)::find($id)->image;
            if(File::exists(public_path('images/users/profile/' . $imageName))){
                File::delete(public_path('images/users/profile/' . $imageName));
            }
        } else if($model === 'Banner') {
            $imageName = getModel($model)::find($id)->image;
            if(File::exists(public_path('images/banners/' . $imageName))){
                File::delete(public_path('images/banners/' . $imageName));
            }
        }

        DB::transaction(function() use ($id, $model) {
            getModel($model)::destroy($id);
        });

        return response()->json([200]);
    }
}
