<?php

namespace App\Enums;

enum WalletEnums: string
{
    case WALLET1 = 'wallet_1';
    case WALLET2 = 'wallet_2';

    /**
     * Check if a given value is a valid enum case.
     */
    public static function isValid(string $type): bool
    {
        return self::tryFrom($type) !== null;
    }
}
