<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(): Factory|View|Application {
        $productCount = Product::all()->count();
        $customerCount = User::all()->count();
        $orderCount = Product::all()->count();
        $sellerCount = Admin::where('type', 'Seller')->count();

        $newOrders = Order::with('user', 'phone')->orderByDesc('id')->limit(5)->get()->toArray();

        return view('Admin.dashboard')
            ->with(compact('productCount', 'customerCount', 'orderCount', 'sellerCount', 'newOrders'));
    }
}
