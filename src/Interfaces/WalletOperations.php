<?php

namespace HPWebdeveloper\LaravelPayPocket\Interfaces;

interface WalletOperations
{
    public function getWalletBalanceAttribute();

    public function getWalletBalanceByType(string $walletType);

    public function hasSufficientBalance($value): bool;

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
