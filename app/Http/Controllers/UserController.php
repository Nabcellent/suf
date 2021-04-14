<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Phone;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Notifications\Notifiable;

use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    use Notifiable;
    //
    public function account(Request $req, $page = 'edit', $id = null): View|Factory|RedirectResponse|Application
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
            $phone = Auth::user()->phone;

            $user -> first_name = $req -> first_name;
            $user -> last_name = $req -> last_name;
            $user -> save();

            $phoneNumber = $req -> phone;
            $phoneNumber = strlen($phoneNumber) === 10 ? substr($phoneNumber, -9) : $phoneNumber;

            $phone -> phone = $phoneNumber;
            $phone -> primary = (Phone::where('user_id', Auth::id())->exists()) ? 0 : 1;
            $phone -> save();

            $message = "Your account has been Updated. 😌";
            return back()
                ->with('alert', ['type' => 'success', 'intro' => 'Prilliant! ', 'message' => $message, 'duration' => 7]);
        }

        if($page === 'delivery-address') {
            $btnAction = "Add";

            $counties = County::where('status', 1)->orderBy('name')->get()->toArray();

            if(url()->previous() === route('checkout')) {
                session(['url.intended' => url()->previous()]);
            }

            if($id !== null) {
                $btnAction = "Update";
                $address = Address::where('id', $id)->with('subCounty')->first()->toArray();

                return view('profile')->with(compact('page' , 'address', 'counties', 'btnAction'));
            }

            return view('profile')->with(compact('page',  'counties', 'btnAction'));
        }

        $user = Auth::user()->toArray();
        $address = Auth::user()->addresses->toArray();

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

    public function deliveryAddress(Request $req, $id = null): Redirector|Application|RedirectResponse
    {
        $req->validate([
            'sub_county' => 'required',
            'address' => 'required',
        ], [
            'address.required' => 'Please input a small description of where your stay (like; house number, street/drive, estate/court)'
        ]);

        if($id === null) {
            $address = new Address;
            $message = "Your delivery address has been added. 😌";
        } else {
            $address = Address::find($id);
            $message = "Your delivery address has been updated. 😌";
        }

        $address->user_id = Auth::id();
        $address->sub_county_id = $req->sub_county;
        $address->address = $req->address;

        $address->save();

        if(!session()->has('url.intended')) {
            session(['url.intended' => url(route('user-account'))]);
        }

        return redirect(session('url.intended'))->with('alert', ['type' => 'success', 'intro' => 'Prilliant! ', 'message' => $message, 'duration' => 7]);
    }

    public function deleteAddress($id): RedirectResponse
    {
        if(!isset($id)) {
            $message = "Something went terribly wrong. Please write to us.";
            return back()->with('alert', ['type' => 'danger', 'intro' => '❗ ', 'message' => $message, 'duration' => 7]);
        }

        Address::destroy($id);

        $message = "Address Deleted.";
        return back()->with('alert', ['type' => 'success', 'intro' => '❗ ', 'message' => $message, 'duration' => 7]);
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

        $check = Phone::where('phone', $phone);

        if(Auth::check()) {
            $check->where('user_id', '<>', Auth::id());
        }

        $exists = $check->exists();

        return $exists ? "false" : "true";
    }
}
