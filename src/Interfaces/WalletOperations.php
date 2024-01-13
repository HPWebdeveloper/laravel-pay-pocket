<?php

namespace HPWebdeveloper\LaravelPayPocket\Interfaces;

interface WalletOperations
{
    /**
     * Get User's Wallet Balance
     */
    public function getWalletBalanceAttribute(): int|float;

    /**
     * Get the balance of a specific wallet type.
     */
    public function getWalletBalanceByType(string $walletType): float|int;

    /**
     *  Check if User's wallet balance is more than given value
     */
    public function hasSufficientBalance(int|float $value): bool;

    /**
     * Pay the order value from the user's wallets.
     *
     * @param  ?string  $notes
     *
     * @throws \HPWebdeveloper\LaravelPayPocket\Exceptions\InsufficientBalanceException
     */
    public function pay(int|float $orderValue, ?string $notes = null): void;

    /**
     * Deposit an amount to the user's wallet of a specific type.
     *
     * @param  ?string  $notes
     */
    public function deposit(string $type, int|float $amount, ?string $notes = null): bool;
}
