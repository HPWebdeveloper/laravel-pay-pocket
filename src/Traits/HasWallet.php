<?php

namespace HPWebdeveloper\LaravelPayPocket\Traits;

use App\Enums\WalletEnums;
use HPWebdeveloper\LaravelPayPocket\Exceptions\InvalidWalletTypeException;
use HPWebdeveloper\LaravelPayPocket\Exceptions\WalletNotFoundException;
use HPWebdeveloper\LaravelPayPocket\Models\Wallet;

trait HasWallet
{
    use GetWallets;

    // you should eager load Wallets

    /**
     *  Has Many Relation with Wallet Model
     */
    public function wallets()
    {
        return $this->morphMany(Wallet::class, 'owner');
    }

    /**
     * Get User's Wallet Balance
     *
     * @return int|float
     */
    public function getWalletBalanceAttribute()
    {

        $totalBalance = 0;

        foreach ($this->walletsInOrder() as $walletInOrder) {
            $walletEnumType = WalletEnums::tryFrom($walletInOrder);
            $wallet = $this->wallets()->where('type', $walletEnumType)->first();

            if ($wallet) {
                $totalBalance += $wallet->balance;
            }
        }

        return $totalBalance;
    }

    /**
     *  Check if User's wallet balance is more than given value
     *
     * @var int|float $value
     *
     * @return bool
     */
    public function hasSufficientBalance($value): bool
    {
        return (int) $this->walletBalance >= (int) $value;
    }

    /**
     * Get the balance of a specific wallet type.
     *
     *
     * @var string $walletType
     *
     * @return float|int
     */
    public function getWalletBalanceByType(string $walletType)
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
}
