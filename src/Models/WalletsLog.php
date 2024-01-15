<?php

namespace HPWebdeveloper\LaravelPayPocket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * HPWebdeveloper\LaravelPayPocket\Models\WalletsLog
 *
 * @property string $status
 * @property int|float $from
 * @property int|float $to
 * @property string $type
 * @property string $ip
 * @property int|float $value
 * @property string $wallet_name
 * @property string $notes
 * @property string $reference
 */
class WalletsLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'from', 'to', 'type', 'ip', 'value', 'wallet_name', 'notes', 'reference',
    ];

    public function loggable(): MorphTo
    {
        return $this->morphTo();
    }

    public function changeStatus($status): bool
    {
        $this->status = $status;

        return $this->save();
    }
}
