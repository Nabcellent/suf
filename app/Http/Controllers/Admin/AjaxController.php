<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Attribute;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Coupon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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


    public function updateStatus(Request $request): JsonResponse {
        $data = $request->all();

        $table = $this->getModel($data['model']);
        $model = $table::find($data['id']);
        $model->status = (Str::lower($data['status']) === "active") ? 0 : 1;
        $model->save();

        return response()->json(['status' => $model->status, 200]);
    }

    public function deleteFromTable($id, $model): JsonResponse {
        $this->getModel($model)::destroy($id);

        return response()->json([200]);
    }



    /*  HELPER FUNCTIONS    */
    private function getModel($model): string {
        return match ($model) {
            'Admin' => Admin::class,
            'Attribute' => Attribute::class,
            'Banner' => Banner::class,
            'Category' => Category::class,
            'Coupon' => Coupon::class,
        };
    }
}
