<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class CustomLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (app()->environment('production')) {
                $log = [
                        'URI' => $request->getUri(),
                        'METHOD' => $request->getMethod(),
                        'REQUEST_BODY' => $request->all(),
                        'RESPONSE' => $response->getContent(),
                    ];
                    Log::build([
                        'driver' => 'single',
                        'path' => storage_path('logs/middleware.log'),
                    ])->info(json_encode($log));
                }

        return $response;
    }
}
