<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function showContacts(): Factory|View|Application {
        $phones = Phone::getPhones()->get()->toArray();

        return view('Admin.Apps.contacts')->with(compact('phones'));
    }

    public function showEmails(): Factory|View|Application {
        $emails = User::select('id', 'email', 'last_name', 'first_name', 'is_admin')->get()->toArray();

        return view('Admin.Apps.emails')->with(compact('emails'));
    }
}
