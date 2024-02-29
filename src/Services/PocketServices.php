<?php

namespace HPWebdeveloper\LaravelPayPocket\Services;

class PocketServices
{
    public function deposit($user, $type, $amount, $notes = null): bool
    {
        return $user->deposit($type, $amount, $notes);
    }

    public function pay($user, $orderValue, array $allowedWallets = [], ?string $notes = null): void
    {
        $user->pay($orderValue, $allowedWallets, $notes);
    }

    public function checkBalance($user)
    {
        return $user->walletBalance;
    }

    public function walletBalanceByType($user, $type)
    {
        return $user->getWalletBalanceByType($type);
    }
}
