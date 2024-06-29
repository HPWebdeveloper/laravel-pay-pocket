<?php

namespace HPWebdeveloper\LaravelPayPocket\Traits;

use App\Enums\WalletEnums;
use HPWebdeveloper\LaravelPayPocket\Exceptions\InvalidDepositException;
use HPWebdeveloper\LaravelPayPocket\Exceptions\InvalidValueException;
use HPWebdeveloper\LaravelPayPocket\Exceptions\InvalidWalletTypeException;
use Illuminate\Support\Facades\DB;

trait HandlesDeposit
{
    /**
     * Deposit an amount to the user's wallet of a specific type.
     *
     * @throws InvalidDepositException
     * @throws InvalidValueException
     * @throws InvalidWalletTypeException
     */
    public function deposit(string $type, int|float $amount, ?string $notes = null): bool
    {
        $depositable = $this->getDepositableTypes();

        if (! $this->isRequestValid($type, $depositable)) {
            throw new InvalidDepositException('Invalid deposit request.');
        }

        if ($amount <= 0) {
            throw new InvalidValueException();
        }

        DB::transaction(function () use ($type, $amount, $notes) {
            $type = WalletEnums::tryFrom($type);
            $wallet = $this->wallets()->firstOrCreate(['type' => $type]);
            $wallet->incrementAndCreateLog($amount, $notes);
        });

        return true;
    }

    /**
     * Get depositable types from WalletEnums.
     */
    private function getDepositableTypes(): array
    {
        $depositableTypes = [];
        foreach (WalletEnums::cases() as $enumCase) {
            $depositableTypes[$enumCase->value] = strtolower($enumCase->name);
        }

        return $depositableTypes;
    }

    /**
     * Check if the given type is valid.
     *
     * @throws InvalidWalletTypeException
     */
    private function isRequestValid($type, array $depositable): bool
    {
        if (! array_key_exists($type, $depositable)) {
            throw new InvalidWalletTypeException('Invalid deposit type.');
        }

        return true;
    }
}
