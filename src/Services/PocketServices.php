<?php

namespace HPWebdeveloper\LaravelPayPocket\Services;

use HPWebdeveloper\LaravelPayPocket\Exceptions\InsufficientBalanceException;
use HPWebdeveloper\LaravelPayPocket\Interfaces\WalletOperations;

class PocketServices
{
    /**
     * Deposit an amount to the user's wallet of a specific type.
     */
    public function deposit(WalletOperations $user, string $type, int|float $amount, ?string $notes = null): bool
    {
        return $user->deposit($type, $amount, $notes);
    }

    /**
     * Pay the order value from the user's wallets.
     *
     * @throws InsufficientBalanceException
     */
    public function pay(WalletOperations $user, int|float $orderValue, ?string $notes = null): void
    {
        $user->pay($orderValue, $notes);
    }

    /**
     * Get the balance of the user.
     */
    public function checkBalance(WalletOperations $user): int|float
    {
        return $user->getWalletBalance();
    }

    /**
     * Get the balance of a specific wallet type.
     */
    public function walletBalanceByType(WalletOperations $user, string $type): int|float
    {
        return $user->getWalletBalanceByType($type);
    }
}
