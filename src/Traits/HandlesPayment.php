<?php

namespace HPWebdeveloper\LaravelPayPocket\Traits;

use HPWebdeveloper\LaravelPayPocket\Exceptions\InsufficientBalanceException;
use Illuminate\Support\Facades\DB;

trait HandlesPayment
{
    /**
     * Pay the order value from the user's wallets.
     *
     *
     * @throws InsufficientBalanceException
     */
    public function pay(int|float $orderValue): void
    {
        if (! $this->hasSufficientBalance($orderValue)) {
            throw new InsufficientBalanceException('Insufficient balance to cover the order.');
        }

        DB::transaction(function () use ($orderValue) {
            $remainingOrderValue = $orderValue;

            $walletsInOrder = $this->wallets()->whereIn('type', $this->walletsInOrder())->get();

            foreach ($walletsInOrder as $wallet) {
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
