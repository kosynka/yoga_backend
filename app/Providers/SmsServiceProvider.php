<?php

namespace App\Providers;

use App\Services\v1\SmsService;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('sms', function () {
            return new SmsService(config('smsckz'));
        });
    }
}
