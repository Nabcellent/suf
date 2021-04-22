<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function profile(): Factory|View|Application {
        $admin = Auth::guard('admin')->user()->toArray();
        $phones = Auth::guard('admin')->user()->phones()->get()->toArray();
        $primaryPhone = Auth::guard('admin')->user()->primaryPhone()->first()->toArray();

        return view('Admin.profile')->with(compact('admin', 'phones', 'primaryPhone'));
    }
}
