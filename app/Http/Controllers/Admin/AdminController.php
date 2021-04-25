<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function profile(): Factory|View|Application {
        $admin = User::with('admin')->find(Auth::id())->toArray();
        $phones = User()->phones()->get()->toArray();
        $primaryPhone = User()->primaryPhone()->first();

        return view('Admin.profile')->with(compact('admin', 'phones', 'primaryPhone'));
    }
}
