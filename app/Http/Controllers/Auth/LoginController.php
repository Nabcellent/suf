<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user): RedirectResponse {
        //  Check if user has active account
        if(!Auth::user()->status) {
            $this->guard()->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return back()->withErrors(['message' => 'Your account is inactive.']);
        }

        //  Update user cart with user id
        if(!empty(Session::get('session_id'))) {
            Cart::where('session_id', Session::get('session_id'))->update(['user_id' => Auth::id()]);

            setCartItems();
        }

        if(Auth::user()->user_type === 'Admin') {
            return redirect()->route('admin.dashboard');
        }

        if(getCart('count') > 0) {
            return redirect()->intended('/cart');
        }

        return redirect()->intended('/products');
    }
}
