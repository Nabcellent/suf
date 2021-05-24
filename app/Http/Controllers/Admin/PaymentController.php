<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StkCallback;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function list(): Factory|View|Application {
        $mpesa = StkCallback::getAll()->latest()->get()->toArray();

        return view('Admin.Payments.list', compact('mpesa'));
    }
}
