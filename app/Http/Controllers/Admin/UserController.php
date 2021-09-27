<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Aid;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Throwable;

class UserController extends Controller {
    public function showCustomers(): Factory|View|Application {
        $customers = User::getCustomers()->latest()->get();

        return view('admin.users.customers', ['customers' => $customers]);
    }

    public function showSellers(): Factory|View|Application {
        $sellers = Admin::getSellers()->latest()->get();

        return view('admin.users.sellers')->with(compact('sellers'));
    }

    public function showAdmins(): Factory|View|Application {
        $admins = Admin::getAdmins()->latest()->get();

        return view('admin.users.admins')->with(compact('admins'));
    }

    public function showAllUsers(): Factory|View|Application {
        $users['users'] = User::with('roles')->where('is_admin', '<>', 7)->latest()->get();

        return view('admin.users.users', $users);
    }


    public function create($user): View|Factory|Redirector|Application|RedirectResponse {
        if($user !== "Customer") {
            $title = "Create";

            return view('admin.users.create')
                ->with(compact('title', 'user'));
        }

        return redirect(route('customers'));
    }

    public function store(StoreUserRequest $request, $user): RedirectResponse {
        $data = $request->all();

        if($user === 'Seller') {
            $request->validate([
                'username' => 'bail|required|max:30|unique:admins',
            ]);
        }

        $data['type'] = ($user === 'Admin') ? 'Admin' : 'Seller';
        $data['ip_address'] = $request->ip();
        $data['is_admin'] = 1;
        $data['password'] = Hash::make($data['type']);

        if($request->has('image')) {
            $image = time() . "." . $data['image']->guessClientExtension();
            $data['image']->move(public_path('images/users/profile'), $image);
            $data['image'] = $image;
        }

        $phone = $request->input('phone');
        $phone = Str::length($phone) > 9 ? Str::substr($phone, -9) : $phone;

        try {
            DB::transaction(function() use ($phone, $data) {
                $user = User::create($data);
                $user->admin()->create($data);
                $user->phones()->create([
                    'phone' => $phone,
                    'primary' => 1
                ]);

                $user->assignRole($data['type']);
            });

            return Aid::createOk("$user Created successfully!", ($user === 'Seller') ? 'admin.sellers' : 'admin.admins');
        } catch(Throwable $e) {
            return Aid::returnToastError($e->getMessage(), 'Error creating user');
        }
    }

    public function edit(string $title, int $id): View|Factory|Redirector|Application|RedirectResponse {
        $data = [
            'title' => $title,
            'user' => User::with('primaryPhone')->find($id)
        ];


        return view('admin.users.create', $data);
    }

    public function update(Request $request, $title, $id): RedirectResponse {
        $request->validate([
            'first_name'  => [
                'required',
                'max:20',
            ],
            'last_name'   => [
                'required',
                'max:20',
            ],
            'national_id' => ['bail', 'required', 'digits:8', Rule::unique('admins')->ignore($id, 'user_id')],
            'email'       => ['required', 'email:rfc,dns', Rule::unique('users')->ignore($id)],
            'gender'      => 'required|alpha',
        ]);

        $data = $request->except(['_method', '_token']);

        if($title === 'Seller') {
            $request->validate([
                'username' => ['bail', 'required', 'max:30', Rule::unique('admins')->ignore($id, 'user_id')],
            ]);
        }

        $user = User::find($id);

        if($request->has('image')) {
            $image = time() . "." . $data['image']->guessClientExtension();
            $data['image']->move(public_path('images/users/profile'), $image);
            $data['image'] = $image;

            if($user->image && file_exists(public_path('images/users/profile' . $user->image))){
                unlink(public_path('images/users/profile/' . $user->image));
            }
        }

        try {
            DB::transaction(function() use ($user, $data) {
                $user->update($data);
                $user->admin->update($data);
            });

            return Aid::updateOk("$title Update successful!", ($title === 'Seller') ? 'admin.sellers' : 'admin.admins');
        } catch(Throwable $e) {
            return Aid::returnToastError($e->getMessage(), 'Error updating user');
        }
    }
}
