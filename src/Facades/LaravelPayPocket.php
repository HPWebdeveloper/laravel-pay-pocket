<?php

namespace HPWebdeveloper\LaravelPayPocket\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HPWebdeveloper\LaravelPayPocket\LaravelPayPocket
 */
class LaravelPayPocket extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \HPWebdeveloper\LaravelPayPocket\Services\PocketServices::class;
    }
}
