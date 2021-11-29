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
use Throwable;

class CategoryController extends Controller
{
    public function showCategories(): Factory|View|Application {
        $data = [
            'sections' => Category::where(['section_id' => null, 'category_id' => null, 'status' => true])
                ->with('categories')->withCount('categories')->get(),
            'categories' =>Category::whereNotNull('section_id')->whereNull('category_id')->with('section')
                ->orderByDesc('id')->get(),
            'subCategories' => Category::with('category')->whereNotNull(['section_id', 'category_id'])
                ->orderByDesc('id')->get()
        ];

        return view('admin.categories.list', $data);
    }

    public function showCategoryForms(Request $request, $id = null): Factory|View|Application {
        $title = "CREATE";
        $sections = Category::sections();
        $categories = Category::whereNotNull('section_id')->whereNull('category_id')->with('section')->get();

        if($id) {
            $title = "UPDATE";

            $category = Category::find($id);

            $view = view('admin.categories.create')
                ->with(compact('title', 'sections', 'categories'));

            if(isset($category['category_id'])) {
                $subCategory = $category;
                $view->with(compact('subCategory'));
            }else {
                $view->with(compact('category'));
            }

            return $view;
        }

        return view('admin.categories.create')
            ->with(compact('title', 'sections', 'categories'));
    }

    public function upsertCategory(StoreCategoryRequest $request, $id = null): RedirectResponse {
        $data = $request->except('_token');
        $message = "";

        if($request->isMethod('POST')) {
            $data = collect($data['sections'])->map(function($section) use ($data) {
                return [
                    'title' => $data['category_title'],
                    'section_id' => $section,
                    'discount' => $data['discount'] ?? 0,
                    'description' => $data['description'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            })->toArray();

            DB::transaction(function() use ($data) {
                Category::insert($data);
            });

            $message = "Category Created.";
        } else if($request->isMethod('PUT')) {
            DB::transaction(function() use ($id, $data) {
                Category::whereId($id)->update([
                    'title' => $data['category_title'],
                    'section_id' => $data['section'],
                    'discount' => $data['discount'],
                    'description' => $data['description'],
                ]);
            });

            $message = "Category Updated.";
        }

        return redirect()->route('admin.categories.index')
            ->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }

    public function upsertSubCategory(StoreCategoryRequest $request, $id = null): RedirectResponse {
        $data = $request->all();

        try {
            if($request->isMethod('POST')) {
                DB::transaction(function() use ($data) {
                    Category::create([
                        'title'       => $data['sub_category_title'],
                        'section_id'  => $data['section'],
                        'category_id' => $data['category'],
                        'discount'    => $data['discount'] ?? 0,
                        'description' => $data['description'],
                    ]);
                });

                $message = "Sub Category Created.";
            } else if($request->isMethod('PUT')) {
                DB::transaction(function() use ($id, $data) {
                    Category::where('id', $id)->update([
                        'title'       => $data['sub_category_title'],
                        'section_id'  => $data['section'],
                        'category_id' => $data['category'],
                        'discount'    => $data['discount'] ?? 0,
                        'description' => $data['description'],
                    ]);
                });

                $message = "Sub Category Updated.";
            }
        } catch (Throwable $e) {
            return toastError($e->getMessage(),'Something went wrong!');
        }

        return redirect()->route('admin.categories.index')
            ->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }
}
