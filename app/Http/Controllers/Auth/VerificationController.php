<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    protected function verified(Request $request): JsonResponse|Redirector|RedirectResponse|Application {
        if($request->user()->is_admin || $request->user()->is_admin === 7) {
            if($request->user()->gender === 'Male') {
                $messageIcon = "🤝🏽";
            } else {
                $messageIcon = "💐";
            }

            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : redirect()->route('admin.dashboard')
                    ->with('alert', [
                        'type' => 'success',
                        'intro' => $messageIcon . $messageIcon,
                        'message' => 'Your email has been verified⚡ Welcome aboard!',
                        'duration' => 10
                    ])
                    ->with('verified', true);
        }

        if($request->user()->gender === 'Male') {
            $messageIcon = "🕺";
        } else {
            $messageIcon = "💃";
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect($this->redirectPath())
                ->with('alert', [
                    'type' => 'success',
                    'intro' => $messageIcon . $messageIcon,
                    'message' => 'Your email has been verified!😁 Enjoy shopping.🥳',
                    'duration' => 7
                ])
                ->with('verified', true);
    }

    /**
     * Show the email verification notice.
     *
     * @param Request $request
     * @return RedirectResponse|View
     */
    public function show(Request $request): View|RedirectResponse {
        if($request->user()->is_admin) {
            return $request->user()->hasVerifiedEmail()
                ? redirect($this->redirectPath())
                : view('admin.auth.verify');
        }

        return $request->user()->hasVerifiedEmail()
            ? redirect($this->redirectPath())
            : view('auth.verify');
    }
}
