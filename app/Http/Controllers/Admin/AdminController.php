<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function profile(): Factory|View|Application {
        $admin = "";

        if(!isRed()) {
            $admin = Admin::with('user')->where('user_id', Auth::id())->first()->toArray();
        }

        $phones = User()->phones()->get()->toArray();
        $primaryPhone = User()->primaryPhone()->first();

        return view('Admin.profile')->with(compact('admin', 'phones', 'primaryPhone'));
    }
}
