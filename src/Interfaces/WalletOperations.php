<?php

namespace HPWebdeveloper\LaravelPayPocket\Interfaces;

interface WalletOperations
{
    public function getWalletBalanceAttribute();

    public function getWalletBalanceByType(string $walletType);

    public function hasSufficientBalance($value): bool;

    public function pay(int|float $orderValue, ?string $notes = null);

    public function deposit(string $type, int|float $amount, ?string $notes = null): bool;
}
