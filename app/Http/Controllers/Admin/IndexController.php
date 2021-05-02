<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Attribute;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\Category;
use App\Models\County;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\productsImage;
use App\Models\SubCounty;
use App\Models\User;
use App\Models\Variation;
use App\Models\VariationsOption;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(): Factory|View|Application {
        if(isSeller()) {
            $newOrders = Order::getSellerOrders()->get()->toArray();
        } else {
            $newOrders = Order::with('user')->orderByDesc('id')->limit(5)->get()->toArray();
        }

        return view('Admin.dashboard')
            ->with(compact('newOrders'));
    }
}
