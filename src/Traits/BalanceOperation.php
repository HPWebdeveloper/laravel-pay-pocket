<?php

namespace HPWebdeveloper\LaravelPayPocket\Traits;

use HPWebdeveloper\LaravelPayPocket\Models\WalletsLog;
use InvalidArgumentException;

trait BalanceOperation
{
    protected WalletsLog $createdLog;

    /**
     * Check if Balance is more than zero.
     */
    public function hasBalance(): bool
    {
        return $this->balance > 0;
    }

    /**
     * Decrement Balance and create a log entry.
     */
    public function decrementAndCreateLog(int|float $value, ?string $notes = null): void
    {
        $this->createLog('dec', $value, $notes);
        $this->decrement('balance', $value);
    }

    /**
     * Increment Balance and create a log entry.
     */
    public function incrementAndCreateLog(int|float $value, ?string $notes = null): void
    {
        $this->createLog('inc', $value, $notes);
        $this->increment('balance', $value);
    }

    /**
     * Create a new log record
     */
    protected function createLog(string $logType, int|float $value, ?string $notes = null): void
    {
        $currentBalance = $this->balance ?? 0;

        $newBalance = $logType === 'dec' ? $currentBalance - $value : $currentBalance + $value;

        $this->createdLog = $this->logs()->create([
            'wallet_name' => $this->type->value,
            'from' => $currentBalance,
            'to' => $newBalance,
            'type' => $logType,
            'ip' => request()->ip(),
            'value' => $value,
            'notes' => $notes,
            'reference' => $this->generateReference(),
        ]);

        $this->createdLog->changeStatus('Done');
    }

    /**
     * @throws InvalidArgumentException
     */
    protected function generateReference(): string
    {
        $className = config('pay-pocket.log_reference_generator_class');
        $methodName = config('pay-pocket.log_reference_generator_method');
        $params = (array) config('pay-pocket.log_reference_params', [12]);
        $prefix = config('pay-pocket.log_reference_prefix');

        if (! is_callable([$className, $methodName])) {
            throw new InvalidArgumentException('Invalid configuration: The combination of log_reference_generator_class and log_reference_generator_method is not callable.');
        }

        $reference = call_user_func([$className, $methodName], ...$params);

        return $prefix.$reference;
    }
}
