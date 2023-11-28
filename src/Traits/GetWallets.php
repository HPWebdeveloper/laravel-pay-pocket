<?php

namespace HPWebdeveloper\LaravelPayPocket\Traits;

use App\Enums\WalletEnums;

trait GetWallets
{
    private function walletsInOrder()
    {
        return array_map(
            function ($enumCase) {
                return $enumCase->value;
            },
            WalletEnums::cases()
        );
    }
}
