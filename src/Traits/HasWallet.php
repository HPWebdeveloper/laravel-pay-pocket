<?php

namespace HPWebdeveloper\LaravelPayPocket\Traits;

use App\Enums\WalletEnums;
use HPWebdeveloper\LaravelPayPocket\Exceptions\InvalidWalletTypeException;
use HPWebdeveloper\LaravelPayPocket\Exceptions\WalletNotFoundException;
use HPWebdeveloper\LaravelPayPocket\Models\Wallet;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property int|float $walletBalance
 */
trait HasWallet
{
    use GetWallets;

    /**
     *  Has Many Relation with Wallet Model
     */
    public function wallets(): MorphMany
    {
        return $this->morphMany(Wallet::class, 'owner');
    }

    /**
     * Get User's Wallet Balance
     */
    public function getWalletBalanceAttribute(): int|float
    {
        return collect($this->walletsInOrder())
            ->reduce(function ($carry, $walletInOrder) {
                $walletEnumType = WalletEnums::tryFrom($walletInOrder);
                $wallet = $this->wallets()->where('type', $walletEnumType)->first();

                if ($wallet) {
                    return $carry + $wallet->balance;
                }

                return $carry;
            }, 0);
    }

    /**
     *  Check if User's wallet balance is more than given value
     */
    public function hasSufficientBalance(int|float $value): bool
    {
        return (int) $this->walletBalance >= (int) $value;
    }

    /**
     * Get the balance of a specific wallet type.
     *
     * @throws InvalidWalletTypeException|WalletNotFoundException
     */
    public function getWalletBalanceByType(string $walletType): int|float
    {
        if (! WalletEnums::isValid($walletType)) {
            throw new InvalidWalletTypeException("Invalid wallet type '{$walletType}'.");
        }

        $wallet = $this->wallets()->where('type', $walletType)->first();

        if (! $wallet) {
            throw new WalletNotFoundException("Wallet of type '{$walletType}' not found.");
        }

        return $wallet->balance;
    }

    public function getWalletBalance(): int|float
    {
        return $this->walletBalance;
    }
}
