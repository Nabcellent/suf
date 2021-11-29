<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Livewire\Component;

class SearchProduct extends Component
{
    public string $term = "";

    public function render(Request $request): Factory|View|Application {
        if(empty($this->term)) {
            $products = Product::with('subCategory', 'brand', 'seller')->where('products.status', 1)
                ->where('stock', '>', 0);

            if($request->has('id')) {
                $id = $request->input('id');

                $categoryCount = Category::where(['id' => $id, 'status' => 1])->count();

                if($categoryCount > 0) {
                    $products->whereIn('products.category_id', Category::categoryDetails($id)['catIds']);
                }
            }
        } else {
            $products = Product::search($this->term)->orWhereHas('subCategory', function($query) {
                $query->where('title', 'like', 'sqs12ess%');
            })->orWhereHas('brand', function($query) {
                $query->where('name', 'like', 'sasa%');
            });
        }

        $data['products'] = $products->paginate(10);

        return view('livewire.search-product', $data);
    }
}
