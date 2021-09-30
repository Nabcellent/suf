<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function profile(): Factory|View|Application {
        $admin = "";

        if(!isRed()) {
            $admin = Admin::with('user')->where('user_id', Auth::id())->first()->toArray();
        }

        $phones = Auth::user()->phones()->get()->toArray();

        return view('admin.profile')->with(compact('admin', 'phones'));
    }

    public function updateProfile(Request $request): JsonResponse|Redirector|Application|RedirectResponse {
        if($request->ajax()) {
            $data = $request->all();
            $user = User::find(Auth::id());

            $valid = Validator::make($data, [
                'first_name' => ['bail', 'required', 'max:20', "regex:/^[a-zA-Z]+(?:(?:\.|[' ])([a-zA-Z])*)*$/i"],
                'last_name' => ['bail', 'required', 'max:20', "regex:/^[a-zA-Z]+(?:(?:\.|[' ])([a-zA-Z])*)*$/i"],
                'username' => [
                    'bail', 'required', 'max:30',
                    Rule ::unique('admins') -> ignore($user->id, 'user_id'),
                ],
            ]);

            if($valid->fails()) {
                $messages = $valid->errors()->messages();

                return response()->json(['status' => false, 'messages' => Arr::collapse($messages)]);
            }

            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->save();

            Admin::where('user_id', Auth::id())->update(['username' => $data['username']]);

            return response()->json(['status' => true, 'message' => 'Profile updated!']);
        }

        return accessDenied();
    }
}
