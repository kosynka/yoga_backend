<?php

namespace App\Providers;

use App\Services\Contracts\AuthServiceInterface;
use App\Services\v1\AuthService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }
}
