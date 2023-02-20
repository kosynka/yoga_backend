<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PhoneVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->phone_verified_at) {
            return $next($request);
        }

        abort(403, 'Your phone is not verified');
    }
}
