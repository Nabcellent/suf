<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Policy;
use Illuminate\Support\Facades\Mail;

class PolicyController extends Controller
{
    //
    public function index(): Factory|View|Application {
        $policies = Policy::all();

        return view('policies', compact('policies'));
    }

    public function showAboutUs(): Factory|View|Application {
        return view('about');
    }
}
