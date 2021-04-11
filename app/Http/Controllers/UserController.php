<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Notifications\Notifiable;

use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\NoReturn;

class UserController extends Controller
{
    use Notifiable;
    //
    public function account(Request $req, $page = null): View|Factory|RedirectResponse|Application
    {
        if($req->isMethod('POST')) {
            $req->validate([
                'first_name' => 'required|max:20|alpha',
                'last_name' => 'required|max:20|alpha',
                'phone' => [
                    'required','digits_between: 9, 10',
                    'regex:/^((7|1)(?:(?:[12569][0-9])|(?:0[0-8])|(4[081])|(3[64]))[0-9]{6})$/i',
                    Rule::unique('addresses')->ignore(Auth::id(), 'user_id'),
                ],
                'address' => 'nullable|min:5'
            ]);

            $phone = strlen($req -> phone) === 10 ? substr($req -> phone, -9) : $req -> phone;

            $user = Auth::user();
            $address = Auth::user()->address;

            $user -> first_name = $req -> first_name;
            $user -> last_name = $req -> last_name;
            $user -> save();

            $address -> phone = $phone;
            $address -> address = $req->address;
            $address -> save();

            $message = "Your account has been Updated. 😌";
            return back()
                ->with('alert', ['type' => 'success', 'intro' => 'Prilliant! ', 'message' => $message, 'duration' => 7]);
        }

        if($page === null) {
            $page = 'edit';
        }
        $user = Auth::user()->toArray();
        $address = Auth::user()->address->toArray();

        return view('profile')->with(compact('page', 'user', 'address'));
    }

    public function updatePassword(Request $req): RedirectResponse
    {
        $req->validate([
            'current_password' => 'password',
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'password_confirmation' => 'required',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($req->password);
        $user->save();

        $message = "Your password has been Updated. 😌";
        return back()
            ->with('alert', ['type' => 'success', 'intro' => 'Success! ', 'message' => $message, 'duration' => 7]);
    }



    /**
     * ---------------------------------------------------------------------------------------------    DATABASE CHECKS
    */

    public function checkCurrentPassword(Request $req): bool
    {
        if($req->ajax() && $req->isMethod('POST')) {
            if(Hash::check($req->current_password, Auth::user()['password'])) {
                return true;
            }

            return false;
        }

        return false;
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

        $check = Address::where('phone', $phone);

        if(Auth::check()) {
            $check->where('user_id', '<>', Auth::id());
        }

        $exists = $check->exists();

        return $exists ? "false" : "true";
    }
}
