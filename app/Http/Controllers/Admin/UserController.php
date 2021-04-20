<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAdminRequest;
use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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


    public function getCreateUser($user, $id = null): View|Factory|Redirector|Application|RedirectResponse {
        if($user !== "Customer") {
            if(!$id) {
                $title = "Create";
            } else {
                $title = "Update";
            }

            return view('Admin.Users.create')
                ->with(compact('title', 'user'));
        }

        return redirect(route('customers'));
    }

    public function createUpdateAdmin(RegisterAdminRequest $request, $user, $id = null): RedirectResponse {
        $data = $request->all();

        DB::transaction(function() use ($request, $user, $data) {
            $password = ($user === 'Admin') ? 'Admin' : 'Seller';

            $admin = Admin::create([
                "first_name" => $data['first_name'],
                "last_name" => $data['last_name'],
                "gender" => $data['gender'],
                "national_id" => $data['national_id'],
                "type" => Str::ucfirst($user),
                "email" => $data['email'],
                "password" => Hash::make($password),
                "ip_address" => $request->ip(),
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]);

            $admin->phones()->create([
                'phone' => $data['phone'],
                'primary' => 1
            ]);
        });

        if($user === 'Seller') {
            $route = redirect()->route('admin.sellers');
        } else {
            $route = redirect()->route('admin.admins');
        }

        $message = $user . " Created.";
        return $route
            ->with('alert', ['type' => 'success', 'intro' => 'Success!', 'message' => $message, 'duration' => 7]);
    }
}
