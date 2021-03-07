<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Foundation\Application;

use App\Models\User;

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

    public function register(Request $req)
    {
        $user = new User;
        $user -> first_name = $req -> first_name;
        $user -> last_name = $req -> last_name;
        $user -> gender = $req -> gender;
        $user -> user_type = $req -> user_type;
        $user -> email = $req -> email;
        $user -> password = Hash::make($req -> password);
        $user -> ip_address = $req -> ip();
        $user -> save();

        return $req -> input();
    }

    public function signOut(Request $request): \Illuminate\Routing\Redirector|Application|\Illuminate\Http\RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/sign-in');
    }
}
