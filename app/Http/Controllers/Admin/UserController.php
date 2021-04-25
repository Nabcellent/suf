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
        $customers = User::getCustomers()->latest()->get()->toArray();

        return view('Admin.Users.customers') ->with(compact('customers'));
    }

    public function showSellers(): Factory|View|Application {
        $sellers = Admin::getSellers()->latest()->get()->toArray();

        return view('Admin.Users.sellers') ->with(compact('sellers'));
    }

    public function showAdmins(): Factory|View|Application {
        $admins = Admin::getAdmins()->latest()->get()->toArray();

        return view('Admin.Users.admins')->with(compact('admins'));
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

    public function createUpdateAdmin(Request $request, $user): RedirectResponse {
        if(($user === "Admin") && !isRed()) {
            return back()
                ->with('alert', alert('danger', "Warning!", 'Unauthorized Action', 8));
        }
        if(!isSeller()) {
            $request->validate([
                'first_name' => ['required', 'max:20', "regex:/^[a-zA-Z]+(?:(?:\.|[' ])([a-zA-Z])*)*$/i"],
                'last_name' => ['required', 'max:20', "regex:/^[a-zA-Z]+(?:(?:\.|[' ])([a-zA-Z])*)*$/i"],
                'email' => 'required|email:rfc,dns|unique:users',
                'gender' => 'required|alpha',
                'phone' => ['required',
                    'numeric',
                    'digits_between:9,12',
                    'unique:phones',
                    'regex:/^((?:254|\+254|0)?((?:7(?:3[0-9]|5[0-6]|(8[5-9]))|1[0][0-2])[0-9]{6})|(?:254|\+254|0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6})|^(?:254|\+254|0)?(77[0-6][0-9]{6})$)$/i'
                ],
            ]);

            $data = $request->all();

            if($user === 'Seller') {
                $request->validate([
                    'username' => 'bail|required|max:30|unique:admins',
                ]);
            }

            $data['type'] = ($user === 'Admin') ? 'Super' : 'Seller';
            $data['ip_address'] = $request->ip();
            $data['is_admin'] = 1;
            $data['password'] = Hash::make($data['type']);

            if($request->has('image')) {
                $imageName = date('dmYHis') . "_" . Str::random(7) . "." . $data['image']->guessClientExtension();
                $data['image']->move(public_path('images/users/profile'), $imageName);
                $data['image'] = $imageName;
            }
            $phone = $request -> phone;
            $phone = Str::length($phone) > 9 ? Str::substr($phone, -9) : $phone;

            DB::transaction(function() use ($phone, $data) {
                $user = User::create($data);
                $user->admin()->create($data);
                $user->phones()->create([
                    'phone' => $phone,
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
