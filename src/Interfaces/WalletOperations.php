<?php

namespace HPWebdeveloper\LaravelPayPocket\Interfaces;

interface WalletOperations
{
    /**
     * Get User's Wallet Balance
     *
     * @return int|float
     */
    public function getWalletBalanceAttribute(): int|float;

    /**
     * Get the balance of a specific wallet type.
     *
     *
     * @param string $walletType
     *
     * @return float|int
     */
    public function getWalletBalanceByType(string $walletType): float|int;

    /**
     *  Check if User's wallet balance is more than given value
     *
     * @param int|float $value
     *
     * @return bool
     */
    public function hasSufficientBalance(int|float $value): bool;

    /**
     * Pay the order value from the user's wallets.
     *
     * @param int|float $orderValue
     * @param array $allowedWallets
     * @param ?string $detail
     *
     * @throws InsufficientBalanceException
     */
    public function pay(int|float $orderValue, array $allowedWallets = [], ?string $detail = null): void;

    /**
     * Deposit an amount to the user's wallet of a specific type.
     *
     * @param string $type
     * @param int|float $amount
     * @param ?string $detail
     *
     * @return bool
     */
    public function deposit(string $type, int|float $amount, ?string $detail = null): bool;
}
