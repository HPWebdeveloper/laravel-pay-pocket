<?php

namespace HPWebdeveloper\LaravelPayPocket\Interfaces;

interface WalletOperations
{
    public function getWalletBalanceAttribute();

    public function getWalletBalanceByType(string $walletType): int|float;

    public function hasSufficientBalance($value): bool;

    public function pay(int|float $orderValue): void;

    public function deposit(string $type, int|float $amount): bool;

    public function getWalletBalance(): int|float;
}
