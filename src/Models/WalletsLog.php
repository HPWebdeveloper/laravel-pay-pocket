<?php

namespace HPWebdeveloper\LaravelPayPocket\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * HPWebdeveloper\LaravelPayPocket\Models\WalletsLog
 *
 * @property string $status
 */
class WalletsLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'from', 'to', 'type', 'ip', 'value', 'wallet_name',
    ];

    public function loggable(): MorphTo
    {
        return $this->morphTo();
    }

    public function changeStatus($status)
    {
        $this->status = $status;

        return $this->save();
    }
}
