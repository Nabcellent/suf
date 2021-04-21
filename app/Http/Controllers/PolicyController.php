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

    public function showContactUsForm(): Factory|View|Application {
        return view('contact_us');
    }

    public function sendEmail(Request $request): RedirectResponse {
        $request->validate([
            'email' => 'required|email:rfc,dns',
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'message' => 'required',
        ]);

        Mail::to(env('MAIL_USERNAME', 'su.fashion10@gmail.com'))->send(new ContactUs($request->all()));

        return back()
            ->with('alert', alert('success', 'Email Sent!', 'Thank you for contacting us. We will get back to you promptly.', 7));
    }
}
