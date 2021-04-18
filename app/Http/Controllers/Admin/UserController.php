<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showCustomers() {
        return view('Admin.Users.customers');
    }

    public function showSellers() {
        return view('Admin.Users.sellers');
    }

    public function showAdmins() {
        return view('Admin.Users.admins');
    }
}
