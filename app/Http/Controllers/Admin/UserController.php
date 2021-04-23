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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function showCustomers(): Factory|View|Application {
        $customers = User::with('primaryPhone')->withCount('orders')->latest()->get()->toArray();

        return view('Admin.Users.customers')
            ->with(compact('customers'));
    }

    public function showSellers(): Factory|View|Application {
        $sellers = Admin::where('type', 'Seller')->with('user')->latest()->get()->toArray();

        return view('Admin.Users.sellers')
            ->with(compact('sellers'));
    }

    public function showAdmins(): Factory|View|Application {
        $admins = Admin::where('type', 'Admin')->with('user')->latest()->get()->toArray();

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

    public function createUpdateAdmin(Request $request, $user, $id = null): RedirectResponse {
        if(Auth::guard('admin')->user()->type === 'Super') {
            $request->validate([
                'first_name' => 'required|max:20|alpha',
                'last_name' => 'required|max:20|alpha',
                'email' => 'required|email:rfc,dns|unique:users',
                'gender' => 'required|alpha',
                'phone' => 'required|integer|digits:9|unique:phones',
                'national_id' => 'required|integer|unique:admins'
            ]);

            $data = $request->all();
            $data['type'] = ($user === 'Admin') ? 'Admin' : 'Seller';
            $data['ip_address'] = $request->ip();
            $data['password'] = Hash::make($data['type']);

            if($request->has('image')) {
                $imageName = date('dmYHis') . "_" . Str::random(7) . "." . $data['image']->guessClientExtension();
                $data['image']->move(public_path('images/users/profile'), $imageName);
                $data['image'] = $imageName;
            }

            DB::transaction(function() use ($data) {
                $user = User::create($data);
                $user->admin()->create($data);
                $user->phones()->create([
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

        return back()
            ->with('alert', alert('danger', "Warning!", 'Unauthorized Action', 8));
    }
}
