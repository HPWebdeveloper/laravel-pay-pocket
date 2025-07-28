<?php

namespace HPWebdeveloper\LaravelPayPocket\Traits;

use HPWebdeveloper\LaravelPayPocket\Exceptions\InsufficientBalanceException;
use Illuminate\Support\Facades\DB;

trait HandlesPayment
{
    /**
     * Pay the order value from the user's wallets.
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

            /**
             * @var \Illuminate\Support\Collection<TKey, \HPWebdeveloper\LaravelPayPocket\Models\Wallet>
             */
            $walletsInOrder = $this->wallets()->whereIn('type', $this->walletsInOrder())->get();

            /**
             * @param string|\App\Enums\WalletEnums
             * @return bool $useWallet
             * */
            $useWallet = function (string|\App\Enums\WalletEnums $wallet) use ($allowedWallets) {
                return count($allowedWallets) < 1 ||
                       in_array($wallet, $allowedWallets) ||
                       in_array($wallet->value, $allowedWallets);
            };

            /**
             * @var BalanceOperation $wallet
             */
            foreach ($walletsInOrder as $wallet) {
                if (! $wallet || ! $wallet->hasBalance() || !$useWallet($wallet->type)) {
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
