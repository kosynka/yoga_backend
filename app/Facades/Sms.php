<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method send(array $data)
 */
class Sms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sms';
    }
}