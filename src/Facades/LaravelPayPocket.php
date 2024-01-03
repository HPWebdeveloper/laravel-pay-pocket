<?php

namespace HPWebdeveloper\LaravelPayPocket\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HPWebdeveloper\LaravelPayPocket\Services\PocketServices
 *
 * @method void pay($user, $orderValue, array $allowedWallets = [], ?string $detail = null)
 * @method bool deposit(string $type, int|float $amount, ?string $detail = null)
 * @method int|float checkBalance()
 * @method int|float walletBalanceByType($user, string $type)
 */
class LaravelPayPocket extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \HPWebdeveloper\LaravelPayPocket\Services\PocketServices::class;
    }
}
