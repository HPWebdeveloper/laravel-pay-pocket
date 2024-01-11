<?php

namespace HPWebdeveloper\LaravelPayPocket\Interfaces;

interface WalletOperations
{
    public function getWalletBalanceAttribute();

    public function getWalletBalanceByType(string $walletType);

    public function hasSufficientBalance($value): bool;

    public function pay(int|float $orderValue, array $allowedWallets = [], ?string $notes = null): void;

    public function deposit(string $type, int|float $amount, ?string $notes = null): bool;
}