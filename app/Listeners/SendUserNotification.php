<?php

namespace App\Listeners;

use App\Events\UserPackageExpired;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendUserNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\UserPackageExpired  $event
     * @return void
     */
    public function handle(UserPackageExpired $event)
    {
        //
    }
}
