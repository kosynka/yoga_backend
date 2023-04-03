<?php

namespace App\Providers;

use App\Services\Contracts\AffiliateServiceInterface;
use App\Services\Contracts\AssignmentServiceInterface;
use App\Services\Contracts\AuthServiceInterface;
use App\Services\Contracts\DictionaryServiceInterface;
use App\Services\Contracts\FileServiceInterface;
use App\Services\Contracts\LessonServiceInterface;
use App\Services\Contracts\PackageServiceInterface;
use App\Services\Contracts\TypeServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use App\Services\v1\AffiliateService;
use App\Services\v1\AssignmentService;
use App\Services\v1\AuthService;
use App\Services\v1\DictionaryService;
use App\Services\v1\FileService;
use App\Services\v1\LessonService;
use App\Services\v1\PackageService;
use App\Services\v1\TypeService;
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
        $this->app->bind(AffiliateServiceInterface::class, AffiliateService::class);
        $this->app->bind(TypeServiceInterface::class, TypeService::class);
        $this->app->bind(LessonServiceInterface::class, LessonService::class);
        $this->app->bind(AssignmentServiceInterface::class, AssignmentService::class);
        $this->app->bind(FileServiceInterface::class, FileService::class);
        $this->app->bind(DictionaryServiceInterface::class, DictionaryService::class);
        $this->app->bind(PackageServiceInterface::class, PackageService::class);
    }
}
