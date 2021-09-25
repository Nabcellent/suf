<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SearchProduct extends Component {
    public string $term = "";

    public function render(): Factory|View|Application {
        $Products = empty($this->term) ? Product::products()->where('products.status', 1)
            : Product::search($this->term)->orWhereHas('subCategory', function($query) {
                $query->where('title', 'like', 'sqs12ess%');
            })->orWhereHas('brand', function($query) {
                $query->where('name', 'like', 'sasa%');
            });

        $data['products'] = $Products->paginate(10);

        return view('livewire.search-product', $data);
    }
}
