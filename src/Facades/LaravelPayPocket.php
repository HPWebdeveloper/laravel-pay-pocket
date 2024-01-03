<?php

namespace HPWebdeveloper\LaravelPayPocket\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HPWebdeveloper\LaravelPayPocket\Services\PocketServices
 *
 * @method static void pay($user, int|float $orderValue, array $allowedWallets = [], ?string $detail = null)
 * @method static bool deposit($user, string $type, int|float $amount, ?string $detail = null)
 * @method static int|float checkBalance($user)
 * @method static int|float walletBalanceByType($user, string $type)
 */
class LaravelPayPocket extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \HPWebdeveloper\LaravelPayPocket\Services\PocketServices::class;
    }
}
