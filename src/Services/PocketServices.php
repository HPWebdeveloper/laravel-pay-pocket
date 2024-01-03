<?php

namespace HPWebdeveloper\LaravelPayPocket\Services;

class PocketServices
{
    /**
     * Deposit an amount to the user's wallet of a specific type.
     *
     * @param $user
     * @param string $type
     * @param int|float $amount
     * @param ?string $detail
     *
     * @return bool
     */
    public function deposit($user, string $type, int|float $amount, ?string $detail = null): bool
    {
        return $user->deposit($type, $amount, $detail);
    }

    /**
     * Pay the order value from the user's wallets.
     *
     * @param $user
     * @param int|float $orderValue
     * @param array $allowedWallets
     * @param ?string $detail
     *
     * @return void
     * @throws InsufficientBalanceException
     */
    public function pay($user, $orderValue, array $allowedWallets = [], ?string $detail = null): void
    {
        return $user->pay($orderValue, $allowedWallets, $detail);
    }

    /**
     * Get the balance of the user.
     *
     *
     * @param $user
     *
     * @return float|int
     */
    public function checkBalance($user): float|int
    {
        return $user->walletBalance;
    }

    /**
     * Get the balance of a specific wallet type.
     *
     *
     * @param $user
     * @param string $type
     *
     * @return float|int
     */
    public function walletBalanceByType($user, string $type): float|int
    {
        return $user->getWalletBalanceByType($type);
    }
}
