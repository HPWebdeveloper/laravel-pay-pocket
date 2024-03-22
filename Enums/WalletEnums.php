<?php

namespace App\Enums;

enum WalletEnums: string
{
    case WALLET1 = 'wallet_1';
    case WALLET2 = 'wallet_2';

    /**
     * Check if a given value is a valid enum case.
     */
    public static function isValid(string|WalletEnums $type): bool
    {
        if (is_string($type)) {
            try {
                $type = WalletEnums::from($type);
            } catch (\ValueError $th) {
                return false;
            }
        }

        foreach (self::cases() as $case) {
            if ($case->value === $type) {
                return true;
            }
        }

        return false;
    }
}
