<?php

namespace HPWebdeveloper\LaravelPayPocket\Services;

use Illuminate\Database\Eloquent\Model;

class PocketServices
{
    /**
     * Deposit an amount to the user's wallet of a specific type.
     *
     * @param  ?string  $notes
     */
    public function deposit(Model $user, string $type, int|float $amount, ?string $notes = null): bool
    {
        return $user->deposit($type, $amount, $notes);
    }

    /**
     * Pay the order value from the user's wallets.
     *
     * @param  ?string  $notes
     *
     * @throws \HPWebdeveloper\LaravelPayPocket\Exceptions\InsufficientBalanceException
     */
    public function pay(Model $user, int|float $orderValue, ?string $notes = null): void
    {
        $user->pay($orderValue, $notes);
    }

    /**
     * Get the balance of the user.
     */
    public function checkBalance(Model $user): int|float
    {
        return $user->walletBalance;
    }

    /**
     * Get the balance of a specific wallet type.
     */
    public function walletBalanceByType(Model $user, string $type): float|int
    {
        return $user->getWalletBalanceByType($type);
    }
}
