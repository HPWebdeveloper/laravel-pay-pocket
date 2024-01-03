<?php

namespace HPWebdeveloper\LaravelPayPocket\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HPWebdeveloper\LaravelPayPocket\Services\PocketServices
 *
 * @method void pay($user, int|float $orderValue, array $allowedWallets = [], ?string $detail = null)
 * @method bool deposit($user, string $type, int|float $amount, ?string $detail = null)
 * @method int|float checkBalance($user)
 * @method int|float walletBalanceByType($user, string $type)
 */
class LaravelPayPocket extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \HPWebdeveloper\LaravelPayPocket\Services\PocketServices::class;
    }
}
