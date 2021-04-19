<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showCustomers(): Factory|View|Application {
        $customers = User::with('primaryPhone')->latest()->get()->toArray();

        return view('Admin.Users.customers')
            ->with(compact('customers'));
    }

    public function showSellers(): Factory|View|Application {
        $sellers = Admin::where('type', 'Seller')->with('primaryPhone')->latest()->get()->toArray();

        return view('Admin.Users.sellers')
            ->with(compact('sellers'));
    }

    public function showAdmins(): Factory|View|Application {
        $admins = Admin::where('type', '<>', 'Seller')->with('primaryPhone')->latest()->get()->toArray();

        return view('Admin.Users.admins')
        ->with(compact('admins'));
    }


    public function getCreateUser(Request $request, $user, $id = null) {
        if($user !== "Customer") {
            if(!$id) {
                $title = "Create";
            } else {
                $title = "Update";
            }

            if($request->isMethod('POST')) {
                $admin = Admin::create([
                    "first_name" => "Michael",
                    "last_name" => "Nabangi",
                    "username" => "lobengula",
                    "gender" => "Male",
                    "national_id" => 36107326,
                    "type" => 'Admin',
                    "email" => "michael.nabz@strathmore.edu",
                    "password" => Hash::make("mike"),
                    "ip_address" => "127.0.0.1",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now(),
                ]);

                $admin->phones()->create([
                    'phone' => 110039317,
                    'primary' => 1
                ]);
            }

            return view('Admin.Users.create')
                ->with(compact('title', 'user'));
        }

        return redirect(route('customers'));
    }
}
