<?php

namespace HPWebdeveloper\LaravelPayPocket\Traits;

use HPWebdeveloper\LaravelPayPocket\Exceptions\InsufficientBalanceException;
use HPWebdeveloper\LaravelPayPocket\Models\WalletsLog;
use Illuminate\Support\Facades\DB;

trait HandlesPayment
{
    /**
     * Pay the order value from the user's wallets.
     *
     * @param int|float $orderValue
     * @param ?string $notes
     *
     * @throws InsufficientBalanceException
     * @return \Illuminate\Support\Collection<TKey,WalletsLog>
     */
    public function pay(int|float $orderValue, ?string $notes = null): \Illuminate\Database\Eloquent\Collection
    {
        if (!$this->hasSufficientBalance($orderValue)) {
            throw new InsufficientBalanceException('Insufficient balance to cover the order.');
        }

        return DB::transaction(function () use ($orderValue, $notes) {
            $remainingOrderValue = $orderValue;

            /**
             * @var \Illuminate\Support\Collection<TKey, \HPWebdeveloper\LaravelPayPocket\Models\Wallet>
             */
            $walletsInOrder = $this->wallets()->whereIn('type', $this->walletsInOrder())->get();

            $logs = (new WalletsLog())->newCollection();

            foreach ($walletsInOrder as $wallet) {
                if (!$wallet || !$wallet->hasBalance()) {
                    continue;
                }

                $amountToDeduct = min($wallet->balance, $remainingOrderValue);
                $logs->push($wallet->decrementAndCreateLog($amountToDeduct, $notes));
                $remainingOrderValue -= $amountToDeduct;

                if ($remainingOrderValue <= 0) {
                    break;
                }
            }

            if ($remainingOrderValue > 0) {
                throw new InsufficientBalanceException('Insufficient total wallet balance to cover the order.');
            }

            return $logs;
        });
    }
}