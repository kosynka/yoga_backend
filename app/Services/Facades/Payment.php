<?php

namespace App\Services\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method generate(array $data)
 * 
 * @method check(array $data)
 * 
 * @method info(array $data)
 */
class Payment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'payment';
    }
}
