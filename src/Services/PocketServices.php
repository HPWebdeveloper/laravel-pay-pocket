<?php

namespace HPWebdeveloper\LaravelPayPocket\Services;

class PocketServices
{
    public function deposit($user, $type, $amount)
    {
        return $user->deposit($type, $amount);
    }

    public function pay($user, $orderValue)
    {
        return $user->pay($orderValue);
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
