<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        $roles = [
            'instructor' => 'INSTRUCTOR',
            'admin' => 'ADMIN',
            'user' => 'USER',
        ];

        if (auth()->user()->role != $roles[$role]) {
            return abort(403, 'Вы не прошли проверку доступа для роли: ' . $roles[$role]);
        }

        return $next($request);
    }
}
