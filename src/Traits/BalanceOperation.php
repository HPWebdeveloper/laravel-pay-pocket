<?php

namespace HPWebdeveloper\LaravelPayPocket\Traits;

trait BalanceOperation
{
    protected $createdLog;

    /**
     *	Check if Balance is more than zero.
     */
    public function hasBalance(): bool
    {
        return $this->balance > 0;
    }

    /**
     *	Decrement Balance and create a log entry.
     */
    public function decrementAndCreateLog($value): void
    {
        $this->createLog('dec', $value);
        $this->decrement('balance', $value);
    }

    /**
     *	Increment Balance and create a log entry.
     */
    public function incrementAndCreateLog($value): void
    {
        $this->createLog('inc', $value);
        $this->increment('balance', $value);
    }

    /**
     *	Create a new log record
     */
    protected function createLog($logType, $value): void
    {
        $currentBalance = $this->balance ?? 0;

        $newBalance = $logType === 'dec' ? $currentBalance - $value : $currentBalance + $value;

        $this->createdLog = $this->logs()->create([
            'wallet_name' => $this->type->value,
            'from' => $currentBalance,
            'to' => $newBalance,
            'type' => $logType,
            'ip' => \Request::ip(),
            'value' => $value,
        ]);

        $this->createdLog->changeStatus('Done');
    }
}
