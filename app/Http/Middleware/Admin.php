<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed {
        if(Auth::user()->is_admin === 7 && Auth::user()->email === env('APP_SUPER_USER_EMAIL')) {
            return $next($request);
        }
        if(!empty(Auth::user()->admin) && Auth::check() && (Auth::user()->is_admin)) {
            return $next($request);
        }

        return back();
    }
}
