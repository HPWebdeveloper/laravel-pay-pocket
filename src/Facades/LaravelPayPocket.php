<?php

namespace HPWebdeveloper\LaravelPayPocket\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HPWebdeveloper\LaravelPayPocket\Services\PocketServices
 *
 * @method static void pay(\Illuminate\Database\Eloquent\Model $user, int|float $orderValue, ?string $notes = null)
 * @method static bool deposit(\Illuminate\Database\Eloquent\Model $user, string $type, int|float $amount, ?string $notes = null)
 * @method static int|float checkBalance(\Illuminate\Database\Eloquent\Model $user)
 * @method static int|float walletBalanceByType(\Illuminate\Database\Eloquent\Model $user, string $type)
 */
class LaravelPayPocket extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \HPWebdeveloper\LaravelPayPocket\Services\PocketServices::class;
    }
}
