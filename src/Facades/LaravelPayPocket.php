<?php

namespace HPWebdeveloper\LaravelPayPocket\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HPWebdeveloper\LaravelPayPocket\Services\PocketServices
 */
class LaravelPayPocket extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \HPWebdeveloper\LaravelPayPocket\Services\PocketServices::class;
    }
}
