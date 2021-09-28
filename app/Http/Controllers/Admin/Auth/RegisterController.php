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
use Throwable;

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
        return view('admin.auth.register');
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
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @param       $request
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

    /**
     * @throws Throwable
     */
    public function register(RegisterAdminRequest $request): View|Factory|JsonResponse|Redirector|RedirectResponse|Application {
        $user = DB::transaction(function() use($request) {
            event(new Registered($user = $this->createAdmin($request->all(), $request)));

            $phone = $request->input('phone');
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
