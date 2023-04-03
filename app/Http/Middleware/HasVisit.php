<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $amount)
    {
        if (auth()->user()->visits_left < $amount) {
            return abort(402, 'У вас осталось меньше ' . $amount . ' посещений. Для записи на урок, продлите подписку');
        }

        return $next($request);
    }
}
