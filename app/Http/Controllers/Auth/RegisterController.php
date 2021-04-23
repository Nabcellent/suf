<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\Cart;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator {
        return Validator::make($data, [
            'first_name' => 'required|max:20|alpha',
            'last_name' => 'required|max:20|alpha',
            'email' => 'required|email:rfc,dns|unique:users',
            'gender' => 'required',
            'phone' => 'required|integer|digits_between: 9, 10|unique:phones',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function createUser(array $data, $ip): User {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'ip_address' => $ip,
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(RegisterUserRequest $request): View|Factory|JsonResponse|Redirector|RedirectResponse|Application {
        $user = DB::transaction(function() use($request) {
            $ip = $request->ip();

            event(new Registered($user = $this->createUser($request->all(), $ip)));

            $phone = $request -> phone;
            $phone = strlen($phone) === 10 ? substr($phone, -9) : $phone;

            $user->phones()->create([
                'phone' => $phone,
                'primary' => 1
            ]);

            return $user;
        });

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user): Factory|View|Redirector|RedirectResponse|Application {
        //  Update user cart with user id
        if(!empty(Session::get('session_id'))) {
            $sessionId = Session::get('session_id');
            Cart::where('session_id', $sessionId)->update(['user_id' => Auth::id()]);
        }

        $type = 'success';
        $intro = "Awesome! 🥳 ";
        $message = "Your account has been activated. Welcome to SU-F Store.";

        if($request->user()->hasVerifiedEmail()) {
            return redirect()->route('login')
                ->with('alert', ['type' => $type, 'intro' => $intro, 'message' => $message, 'duration' => 10]);
        }

        return view('auth.verify');
    }
}
