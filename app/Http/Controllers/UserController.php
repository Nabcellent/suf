<?php

namespace App\Http\Controllers;

use App\Models\{County, Phone, User, Address};
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Foundation\Application;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller {
    public function account(Request $request, $page = 'edit', $id = null): View|Factory|RedirectResponse|Application {
        if($request->isMethod('POST')) {
            $request->validate([
                'first_name' => 'required|max:20|alpha',
                'last_name' => 'required|max:20|alpha',
                'address' => 'nullable|min:5'
            ]);

            $user = Auth::user();

            $user -> first_name = $request->input('first_name');
            $user -> last_name = $request->input('last_name');
            $user -> save();

            $message = "Your account has been Updated. 😌";
            return back()
                ->with('alert', ['type' => 'success', 'intro' => 'Prilliant! ', 'message' => $message, 'duration' => 7]);
        }

        if($page === 'delivery-address') {
            $btnAction = "Add";
            $counties = County::where('status', 1)->orderBy('name')->get();

            if(url()->previous() === route('checkout')) {
                session(['url.intended' => url()->previous()]);
            }

            if($id !== null) {
                $btnAction = "Update";
                $address = Address::where('id', $id)->with('subCounty')->first();

                return view('profile')->with(compact('page' , 'address', 'counties', 'btnAction'));
            }

            return view('profile')->with(compact('page',  'counties', 'btnAction'));
        }

        $data = [
            'page' => $page,
            'user' => User::with('phones', 'addresses')->findOrFail(Auth::id())
        ];

        return view('profile', $data);
    }

    public function deliveryAddress(Request $request, $id = null): Redirector|Application|RedirectResponse
    {
        $request->validate([
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
        $address->sub_county_id = $request->input('sub_county');
        $address->address = $request->input('address');

        $address->save();

        if(!session()->has('url.intended')) {
            session(['url.intended' => url(route('profile'))]);
        }

        return redirect(session('url.intended'))->with('alert', ['type' => 'success', 'intro' => 'Prilliant! ', 'message' => $message, 'duration' => 7]);
    }

    public function createUpdatePhone(Request $request): JsonResponse {
        $data = $request->all();
        $rules = [
            'required',
            'numeric',
            'digits_between:9,12',
            'regex:/^((?:254|\+254|0)?((?:7(?:3[0-9]|5[0-6]|(8[5-9]))|1[0][0-2])[0-9]{6})|(?:254|\+254|0)?((?:7(?:[01249][0-9]|5[789]|6[89])|1[1][0-5])[0-9]{6})|^(?:254|\+254|0)?(77[0-6][0-9]{6})$)$/i'
        ];

        if($request->input('id')) {
            $rules[] = Rule ::unique('phones')->ignore($request->input('id'));
        } else {
            $rules[] = 'unique:phones';
        }

        $phone = $request->input('phone');
        $phone = Str::length($phone) > 9 ? Str::substr($phone, -9) : $phone;
        $data['phone'] = $phone;
        $valid = Validator::make($data, ['phone' => $rules]);

        if($valid->fails()) {
            $message = $valid->errors()->messages()['phone'][0];

            return response()->json(['status' => false, 'message' => $message]);
        }

        $user = User::find(Auth::id());

        if(!$request->input('id')) {
            $user->phones()->create([
                'phone' => $phone,
                'primary' => 0
            ]);

            $message = 'Phone has been added!';
        } else {
            $updatePhone = Phone::find($request->input('id'));
            $updatePhone->phone = $phone;
            $updatePhone->save();

            $message = 'Phone has been updated!';
        }

        return response()->json(['status' => true, 'message' => $message]);
    }

    public function uploadProfilePic(Request $request): RedirectResponse {
        $file = $request->file('image');
        $imageName = date('dmYHis') . "_" . Str::random(7) . "." . $file->guessClientExtension();
        $file->move(public_path('images/users/profile'), $imageName);

        $user = Auth::user();
        $user->image = $imageName;
        $user->save();

        return back()->with('alert', alert('success', 'Success', 'Profile picture saved', 7));
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => 'password',
            'password' => ['required', 'string', 'min:7', 'confirmed'],
            'password_confirmation' => 'required',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $message = "Your password has been Updated. 😌";
        return back()
            ->with('alert', ['type' => 'success', 'intro' => 'Success! ', 'message' => $message, 'duration' => 7]);
    }




    public function deletePhone($id): RedirectResponse
    {
        if(!isset($id)) {
            $message = "Something went terribly wrong. Please write to us.";
            return back()->with('alert', ['type' => 'danger', 'intro' => '❗ ', 'message' => $message, 'duration' => 7]);
        }

        Phone::destroy($id);

        $message = "Phone Deleted.";
        return back()->with('alert', ['type' => 'success', 'intro' => '❗ ', 'message' => $message, 'duration' => 7]);
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



    public function deleteAccount(): RedirectResponse {
        $user = User::find(Auth::id());

        Auth::logout();

        if($user->delete()) {
            $message = "It was great having you as our customer.";
            return redirect()->route('home')
                ->with('alert', ['type' => 'success', 'intro' => '💔', 'message' => $message, 'duration' => 7]);
        }

        $message = "Unable to delete. Kindly contact us.";
        return back()
            ->with('alert', ['type' => 'warning', 'intro' => '❗ ', 'message' => $message, 'duration' => 7]);
    }
}
