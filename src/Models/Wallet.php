<?php

namespace HPWebdeveloper\LaravelPayPocket\Models;

use App\Enums\WalletEnums;
use HPWebdeveloper\LaravelPayPocket\Traits\BalanceOperation;
use HPWebdeveloper\LaravelPayPocket\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * HPWebdeveloper\LaravelPayPocket\Models\Wallet
 *
 * @property mixed $balance
 * @property WalletEnums $type
 */
class Wallet extends Model
{
    use BalanceOperation;
    use HasFactory;
    use Loggable;

    protected $guarded = ['id'];

    protected $casts = [
        'type' => WalletEnums::class,
    ];

    public function owner(): MorphTo
    {
        return $this->morphTo();
    }
}
