<?php

namespace HPWebdeveloper\LaravelPayPocket\Traits;

use App\Enums\WalletEnums;

trait GetWallets
{
    private function walletsInOrder(): array
    {
        return array_map(
            fn ($enumCase) => $enumCase->value,
            WalletEnums::cases()
        );
    }
}
