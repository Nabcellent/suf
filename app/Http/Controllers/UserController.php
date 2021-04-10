<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Foundation\Application;

use App\Models\User;
use App\Models\Address;
use App\Http\Requests\RegisterPostRequest;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function authenticate(Request $req): RedirectResponse
    {
        $credentials = $req->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();

            //  Update user cart with user id
            if(!empty(Session::get('session_id'))) {
                $sessionId = Session::get('session_id');
                Cart::where('session_id', $sessionId)->update(['user_id' => Auth::id()]);
            }

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function createUser(RegisterPostRequest $req): Redirector|Application|RedirectResponse
    {
        if($req->isMethod('POST')) {
            $phone = $req -> validated()['phone'];
            $phone = strlen($phone) === 10 ? substr($phone, -9) : $phone;

            $user = new User;
            $address = new Address;

            $user -> first_name = $req->validated()['first_name'];
            $user -> last_name = $req->validated()['last_name'];
            $user -> gender = $req->validated()['gender'];
            $user -> user_type = "Customer";
            $user -> email = $req->validated()['email'];
            $user -> password = Hash::make($req->validated()['password']);
            $user -> ip_address = $req -> ip();
            $user -> save();

            $address -> user_id = $user -> id;
            $address -> phone = $phone;
            $address -> save();

            $credentials = $req->only('email', 'password');
            if(Auth::attempt($credentials)) {
                $req->session()->regenerate();

                //  Update user cart with user id
                if(!empty(Session::get('session_id'))) {
                    $sessionId = Session::get('session_id');
                    Cart::where('session_id', $sessionId)->update(['user_id' => Auth::id()]);
                }

                return redirect()->intended('/products');
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        $message = "Access Denied!";
        return redirect('/login')
            ->with('alert', ['type' => 'danger', 'intro' => 'Sorry!', 'message' => $message]);
    }

    public function update(Request $req): RedirectResponse
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

    public function signOut(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function checkEmailExists(Request $req): string
    {
        //  Check if email exists
        $exists = User::where('email', $req->email)->exists();

        return $exists ? "false" : "true";
    }

    public function checkPhoneExists(Request $req): string
    {
        $phone = $req -> phone;
        $phone = strlen($phone) === 10 ? substr($phone, -9) : $phone;
        $exists = Address::where('phone', $req -> phone)->exists();

        return $exists ? "false" : "true";
    }
}
