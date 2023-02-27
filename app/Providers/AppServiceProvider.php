<?php

namespace App\Providers;

use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\FileServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\v1\AuthService;
use App\Services\v1\FileService;
use App\Services\v1\UserService;
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
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(FileServiceInterface::class, FileService::class);
    }
}
