<?php

namespace HPWebdeveloper\LaravelPayPocket\Services;

use HPWebdeveloper\LaravelPayPocket\Interfaces\WalletOperations;

class PocketServices
{
    public function deposit(WalletOperations $user, string $type, int|float $amount): bool
    {
        return $user->deposit($type, $amount);
    }

    public function pay(WalletOperations $user, int|float $orderValue): void
    {
        $user->pay($orderValue);
    }

    public function checkBalance(WalletOperations $user): int|float
    {
        return $user->getWalletBalance();
    }

    public function walletBalanceByType(WalletOperations $user, string $type): int|float
    {
        return $user->getWalletBalanceByType($type);
    }
}
