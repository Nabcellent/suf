<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Super
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(isRed() || isSuper()) {
            return $next($request);
        }

        return accessDenied();
    }
}
