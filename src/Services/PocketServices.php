<?php

namespace HPWebdeveloper\LaravelPayPocket\Services;

use Illuminate\Database\Eloquent\Model;

class PocketServices
{
    public function deposit(Model $user, string $type, int|float $amount): bool
    {
        return $user->deposit($type, $amount);
    }

    public function pay(Model $user, int|float $orderValue): void
    {
        $user->pay($orderValue);
    }

    public function checkBalance(Model $user): int|float
    {
        return $user->walletBalance;
    }

    public function walletBalanceByType(Model $user, string $type): int|float
    {
        return $user->getWalletBalanceByType($type);
    }
}
