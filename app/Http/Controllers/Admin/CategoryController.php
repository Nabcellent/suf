<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showCategories() {
        $sections = Category::sections();
        $categories = Category::whereNotNull('section_id')->whereNull('category_id')->with('section')->get()->toArray();
        $subCategories = Category::with('category')->whereNotNull(['section_id', 'category_id'])->get()->toArray();

        return view('Admin.Categories.list')
            ->with(compact('sections', 'categories', 'subCategories'));
    }
}
