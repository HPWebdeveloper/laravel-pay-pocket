<?php

namespace HPWebdeveloper\LaravelPayPocket\Facades;

use HPWebdeveloper\LaravelPayPocket\Interfaces\WalletOperations;
use Illuminate\Support\Facades\Facade;

/**
 * @see \HPWebdeveloper\LaravelPayPocket\Services\PocketServices
 *
 * @method static void pay(WalletOperations $user, int|float $orderValue, ?string $notes = null)
 * @method static bool deposit(WalletOperations $user, string $type, int|float $amount, ?string $notes = null)
 * @method static int|float checkBalance(WalletOperations $user)
 * @method static int|float walletBalanceByType(WalletOperations $user, string $type)
 */
class LaravelPayPocket extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \HPWebdeveloper\LaravelPayPocket\Services\PocketServices::class;
    }
}
