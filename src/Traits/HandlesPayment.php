<?php

namespace HPWebdeveloper\LaravelPayPocket\Traits;

use App\Enums\WalletEnums;
use HPWebdeveloper\LaravelPayPocket\Exceptions\InsufficientBalanceException;
use Illuminate\Support\Facades\DB;

trait HandlesPayment
{
    /**
     * Pay the order value from the user's wallets.
     *
     * @return void
     *
     * @throws InsufficientBalanceException
     */
    public function pay(int|float $orderValue)
    {
        if (! $this->hasSufficientBalance($orderValue)) {
            throw new InsufficientBalanceException('Insufficient balance to cover the order.');
        }

        DB::transaction(function () use ($orderValue) {
            $remainingOrderValue = $orderValue;

            foreach ($this->walletsInOrder() as $walletInOrder) {
                $walletEnumType = WalletEnums::tryFrom($walletInOrder);
                $wallet = $this->wallets()->where('type', $walletEnumType)->first();

                if (! $wallet || ! $wallet->hasBalance()) {
                    continue;
                }

                $amountToDeduct = min($wallet->balance, $remainingOrderValue);
                $wallet->decrementAndCreateLog($amountToDeduct);
                $remainingOrderValue -= $amountToDeduct;

                if ($remainingOrderValue <= 0) {
                    break;
                }
            }

            if ($remainingOrderValue > 0) {
                throw new InsufficientBalanceException('Insufficient total wallet balance to cover the order.');
            }
        });
    }
}
