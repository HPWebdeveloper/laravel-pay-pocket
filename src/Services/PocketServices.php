<?php

namespace HPWebdeveloper\LaravelPayPocket\Services;

class PocketServices
{
    public function deposit($user, $type, $amount, $notes = null)
    {
        return $user->deposit($type, $amount, $notes);
    }

    public function pay($user, $orderValue, $notes = null)
    {
        return $user->pay($orderValue, $notes);
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
