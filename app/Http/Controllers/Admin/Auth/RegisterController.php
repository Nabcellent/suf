<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterAdminRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm(): \Illuminate\View\View {
        return view('Admin.auth.register');
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected string $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
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
            'phone' => ['required',
                'numeric',
                'digits_between:9,12',
                'unique:phones',
                'regex:/^((?:254|\+254|0)?((?:7(?:3[0-9]|5[0-6]|(8[5-9]))|1[0][0-2])[0-9]{6})|(?:254|\+254|0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6})|^(?:254|\+254|0)?(77[0-6][0-9]{6})$)$/i'
            ],
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function createAdmin(array $data, $request): User {
        $data['type'] = "Seller";
        $data['ip_address'] = $request->ip();
        $data['password'] = bcrypt($data['password']);
        $data['is_admin'] = 1;

        $user = User::create($data);
        $user->admin()->create($data);
        return $user;
    }

    public function register(RegisterAdminRequest $request): View|Factory|JsonResponse|Redirector|RedirectResponse|Application {
        $user = DB::transaction(function() use($request) {
            event(new Registered($user = $this->createAdmin($request->all(), $request)));

            $phone = $request -> phone;
            $phone = Str::length($phone) > 9 ? Str::substr($phone, -9) : $phone;

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

    /**
     * The user has been registered.
     *
     * @param \Illuminate\Http\Request $request
     * @param                          $user
     * @return mixed
     */
    protected function registered(Request $request, $user): mixed {
        $type = 'success';
        $intro = "Awesome! ⚡ ";
        $message = "Your account has been activated. Welcome to SU-F Dashboard.";

        if($request->user()->hasVerifiedEmail()) {
            return redirect()->route('admin.login')
                ->with('alert', ['type' => $type, 'intro' => $intro, 'message' => $message, 'duration' => 10]);
        }

        return redirect()->route('verification.notice');
    }
}
