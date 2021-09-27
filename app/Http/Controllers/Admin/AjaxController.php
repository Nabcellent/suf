<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Variation;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Throwable;

class AjaxController extends Controller
{
    public function getCategoriesBySectionId(Request $request): JsonResponse {
        $id = $request->input('id');
        $categories = Category::where('section_id', $id)->whereNull('category_id')->get()->toArray();

        if($request->has('categoryId')) {
            $options = '';
            $categoryId = $request->input('categoryId');

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
        $id = $request->input('id');
        $subCats = Category::where('category_id', $id)->get()->toArray();

        $result = '<option selected hidden value="">Select a sub-category *</option>';
        foreach($subCats as $subCat) {
            $result .= '<option value="' . $subCat['id'] . '">' . $subCat['title'] . '</option>';
        }

        return response()->json(['subCategories' => $result, 200]);
    }

    public function getAttributeValuesByAttrId(Request $request): JsonResponse {
        $id = $request->input('id');
        $values = Attribute::find($id)->toArray();

        try {
            $values = json_decode($values['values'], true, 512, JSON_THROW_ON_ERROR);
        } catch(Exception $e) {
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

        if(strtolower($data['model']) === 'variations_option') {
            $model = Variation::findOrFail($data['id']['id']);

            $varOptions = $model->options;
            $varOptions[$data['id']['key']]['status'] = (Str::lower($data['status']) === "active") ? 0 : 1;
            $model->options = $varOptions;
        } else {
            $model = $table::find($data['id']);
            $model->status = (Str::lower($data['status']) === "active") ? 0 : 1;
        }

        $model->save();

        $newStatus = (Str::lower($data['status']) === "active") ? 0 : 1;

        return response()->json(['status' => $newStatus, 200]);
    }

    /**
     * @throws Throwable
     */
    public function deleteFromTable(Request $request): JsonResponse {
        $model = $request->input('model');
        $ids = $request->input('ids');

        if($model === "Product's Image" || $model === "Product") {
            $images = getModel($model)::findMany($ids, ['image']);
            $basePath = 'images/products/';
        } else if($model === "User") {
            $images = getModel($model)::findMany($ids, ['image']);
            $basePath = 'images/users/profile/';
        } else if($model === 'Banner') {
            $images = getModel($model)::findMany($ids, ['image']);
            $basePath = 'images/banners/';
        }

        if(isset($images) && isset($basePath))
            foreach($images as $image)
                if(File::exists(public_path($basePath . $image->image)))
                    File::delete(public_path($basePath . $image->image));

        DB::transaction(function() use ($ids, $model) {
            getModel($model)::destroy($ids);
        });

        return response()->json([200]);
    }
}
