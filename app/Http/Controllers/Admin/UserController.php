<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showCustomers(): Factory|View|Application {
        $customers = User::with('primaryPhone')->latest()->get()->toArray();
        //dd($customers);

        return view('Admin.Users.customers')
            ->with(compact('customers'));
    }

    public function showSellers(): Factory|View|Application {
        $sellers = Admin::where('type', 'Seller')->with('phones')->latest()->get()->toArray();

        return view('Admin.Users.sellers')
            ->with(compact('sellers'));
    }

    public function showAdmins(): Factory|View|Application {
        $admins = Admin::where('type', '<>', 'Seller')->with('phones')->latest()->get()->toArray();

        return view('Admin.Users.admins')
        ->with(compact('admins'));
    }
}
