<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Foundation\Application;

use App\Models\User;
use App\Models\Address;
use App\Http\Requests\RegisterPostRequest;

class UserController extends Controller
{
    //
    public function authenticate(Request $req): \Illuminate\Http\RedirectResponse
    {
        $credentials = $req->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function create(RegisterPostRequest $req): \Illuminate\Routing\Redirector|Application|\Illuminate\Http\RedirectResponse
    {
        $phone = strlen($req -> validated()['phone']) === 10 ? substr($req -> validated()['phone'], -9) : $req -> validated()['phone'];

        $user = new User;
        $address = new Address;

        $user -> first_name = $req->validated()['first_name'];
        $user -> last_name = $req->validated()['last_name'];
        $user -> gender = $req->validated()['gender'];
        $user -> user_type = $req->validated()['user_type'];
        $user -> email = $req->validated()['email'];
        $user -> password = Hash::make($req->validated()['password']);
        $user -> ip_address = $req -> ip();
        $user -> save();

        $address -> user_id = $user -> id;
        $address -> phone = $phone;
        $address -> save();

        return redirect('/sign-in');
    }

    public function update(Request $req): \Illuminate\Http\RedirectResponse
    {
        $phone = strlen($req -> phone) === 10 ? substr($req -> phone, -9) : $req -> phone;

        $user = User::find(Auth::id());
        $address = Address::firstWhere('user_id', Auth::id());

        $user -> first_name = $req -> first_name;
        $user -> last_name = $req -> last_name;
        $user -> save();

        $address -> phone = $phone;
        $address -> save();

        return back();
    }

    public function signOut(Request $request): \Illuminate\Routing\Redirector|Application|\Illuminate\Http\RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/sign-in');
    }
}
