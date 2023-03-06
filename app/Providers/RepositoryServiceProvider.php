<?php

namespace App\Providers;

use App\Repositories\Contracts\AffiliateRepositoryInterface;
use App\Repositories\Contracts\AssignmentRepositoryInterface;
use App\Repositories\Contracts\CityRepositoryInterface;
use App\Repositories\Contracts\FileRepositoryInterface;
use App\Repositories\Contracts\LessonRepositoryInterface;
use App\Repositories\Contracts\TypeRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\v1\AffiliateRepository;
use App\Repositories\v1\AssignmentRepository;
use App\Repositories\v1\CityRepository;
use App\Repositories\v1\FileRepository;
use App\Repositories\v1\LessonRepository;
use App\Repositories\v1\TypeRepository;
use App\Repositories\v1\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    { 
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AffiliateRepositoryInterface::class, AffiliateRepository::class);
        $this->app->bind(TypeRepositoryInterface::class, TypeRepository::class);
        $this->app->bind(LessonRepositoryInterface::class, LessonRepository::class);
        $this->app->bind(AssignmentRepositoryInterface::class, AssignmentRepository::class);
        $this->app->bind(FileRepositoryInterface::class, FileRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
    }
}
