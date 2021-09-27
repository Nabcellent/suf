<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    public function index(): Factory|View|Application {
        if(isSeller()) {
            $newOrders = Order::getSellerOrders();
        } else {
            $newOrders = Order::with('user')->orderByDesc('id');
        }

        $data = [
            'newOrders' => $newOrders->limit(5)->get(),
        ];

        return view('admin.dashboard', $data);
    }
}
