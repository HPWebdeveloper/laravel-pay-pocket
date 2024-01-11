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
    public function pay(int|float $orderValue, array $allowedWallets = [], ?string $notes = null): void
    {
        if (! $this->hasSufficientBalance($orderValue)) {
            throw new InsufficientBalanceException('Insufficient balance to cover the order.');
        }

        DB::transaction(function () use ($orderValue, $notes, $allowedWallets) {
            $remainingOrderValue = $orderValue;

            $walletsInOrder = $this->wallets()->whereIn('type', $this->walletsInOrder())->get();

            /**
             * @param string $wallet
             * @return bool $useWallet
             * */
            $useWallet = fn ($wallet) => count($allowedWallets) < 1 || in_array($wallet, $allowedWallets);

            /**
             * @var BalanceOperation $wallet
             */
            foreach ($walletsInOrder as $wallet) {
                if (! $wallet || ! $wallet->hasBalance() || !$useWallet($wallet->type->value)) {
                    continue;
                }

                $amountToDeduct = min($wallet->balance, $remainingOrderValue);
                $wallet->decrementAndCreateLog($amountToDeduct, $notes);
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
