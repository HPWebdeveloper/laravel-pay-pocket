<?php

namespace HPWebdeveloper\LaravelPayPocket\Traits;

use HPWebdeveloper\LaravelPayPocket\Models\WalletsLog;

trait Loggable
{
    public function logs()
    {
        return $this->morphMany(WalletsLog::class, 'loggable');
    }
}
