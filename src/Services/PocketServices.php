<?php

namespace HPWebdeveloper\LaravelPayPocket\Services;

class PocketServices
{
    public function deposit($user, $type, $amount, ?string $detail = null)
    {
        return $user->deposit($type, $amount, $detail);
    }

    public function pay($user, $orderValue, array $restrictedWallets = [], ?string $detail = null)
    {
        return $user->pay($orderValue, $restrictedWallets, $detail);
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