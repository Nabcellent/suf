<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function showCategories(): Factory|View|Application {
        $sections = Category::sections();
        $categories = Category::whereNotNull('section_id')->whereNull('category_id')->with('section')
            ->orderByDesc('id')->get();
        $subCategories = Category::with('category')->whereNotNull(['section_id', 'category_id'])
        ->orderByDesc('id')->get();

        return view('Admin.Categories.list')
            ->with(compact('sections', 'categories', 'subCategories'));
    }

    public function showCategoryForms(Request $request, $id = null): Factory|View|Application {
        $title = "CREATE";
        $sections = Category::sections();
        $categories = Category::whereNotNull('section_id')->whereNull('category_id')->with('section')->get();

        if($id) {
            $title = "UPDATE";

            $category = Category::find($id);

            $view = view('Admin.Categories.create')
                ->with(compact('title', 'sections', 'categories'));

            if(isset($category['category_id'])) {
                $subCategory = $category;
                $view->with(compact('subCategory'));
            }else {
                $view->with(compact('category'));
            }

            return $view;
        }

        return view('Admin.Categories.create')
            ->with(compact('title', 'sections', 'categories'));
    }

    public function createUpdateCategory(StoreCategoryRequest $request, $id = null): RedirectResponse {
        $data = $request->all();
        $message = "";

        if($request->isMethod('POST')) {
            DB::transaction(function() use ($data) {
                foreach($data['sections'] as $section) {
                    Category::create([
                        'title' => $data['category_title'],
                        'section_id' => $section,
                        'discount' => $data['discount'],
                        'description' => $data['description'],
                    ]);
                }
            });

            $message = "Category Created.";
        } else if($request->isMethod('PUT')) {
            DB::transaction(function() use ($id, $data) {
                Category::where('id', $id)->update([
                    'title' => $data['category_title'],
                    'section_id' => $data['section'],
                    'discount' => $data['discount'],
                    'description' => $data['description'],
                ]);
            });

            $message = "Category Updated.";
        }

        return redirect()->route('admin.categories')
            ->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }

    public function createUpdateSubCategory(StoreCategoryRequest $request, $id = null): RedirectResponse {
        $data = $request->all();

        if($request->isMethod('POST')) {
            DB::transaction(function() use ($data) {
                Category::create([
                    'title' => $data['sub_category_title'],
                    'section_id' => $data['section'],
                    'category_id' => $data['category'],
                    'discount' => $data['discount'],
                    'description' => $data['description'],
                ]);
            });

            $message = "Sub Category Created.";
        } elseif($request->isMethod('PUT')) {
            DB::transaction(function() use ($id, $data) {
                Category::where('id', $id)->update([
                    'title' => $data['sub_category_title'],
                    'section_id' => $data['section'],
                    'category_id' => $data['category'],
                    'discount' => $data['discount'],
                    'description' => $data['description'],
                ]);
            });

            $message = "Sub Category Updated.";
        }

        return redirect()->route('admin.categories')
            ->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }
}
