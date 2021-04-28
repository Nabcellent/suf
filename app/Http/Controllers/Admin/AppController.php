<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function showContacts() {
        $phones = Phone::getPhones()->get()->toArray();

        return view('Admin.Apps.contacts')->with(compact('phones'));
    }
}
