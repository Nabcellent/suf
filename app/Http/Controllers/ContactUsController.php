<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
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

        Mail::to(env('MAIL_USERNAME', 'su.fashion10@gmail.com'))->queue(new ContactUs($request->all()));

        return back()
            ->with('alert', alert('success', 'Email Sent!', 'Thank you for contacting us. We will get back to you promptly.', 7));
    }
}
