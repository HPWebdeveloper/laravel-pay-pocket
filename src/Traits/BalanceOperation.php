<?php

namespace HPWebdeveloper\LaravelPayPocket\Traits;

use Illuminate\Support\Str;

trait BalanceOperation
{
    protected $createdLog;

    /**
     * Check if Balance is more than zero.
     *
     * @return bool
     */
    public function hasBalance(): bool
    {
        return $this->balance > 0;
    }

    /**
     * Decrement Balance and create a log entry.
     *
     * @var int|float $value
     * @var ?string $detail
     *
     * @return void
     */
    public function decrementAndCreateLog($value, ?string $detail = null): void
    {
        $this->createLog('dec', $value, $detail);
        $this->decrement('balance', $value);
    }

    /**
     * Increment Balance and create a log entry.
     *
     * @var int|float $value
     * @var ?string $detail
     *
     * @return void
     */
    public function incrementAndCreateLog($value, ?string $detail = null): void
    {
        $this->createLog('inc', $value, $detail);
        $this->increment('balance', $value);
    }

    /**
     * Create a new log record
     *
     * @var string $logType
     * @var int|float $value
     * @var ?string $detail
     *
     * @return void
     */
    protected function createLog($logType, $value, ?string $detail = null): void
    {
        $currentBalance = $this->balance ?? 0;

        $newBalance = $logType === 'dec' ? $currentBalance - $value : $currentBalance + $value;

        $refGen = config('pay-pocket.log_reference_generator', [Str::class, 'random', [12]]);

        $reference = config('pay-pocket.log_reference_prefix', '');

        $reference .= isset($refGen[0], $refGen[1])
            ? $refGen[0]::{$refGen[1]}(...$refGen[2] ?? [])
            : Str::random(config('pay-pocket.log_reference_length', 12));

        $this->createdLog = $this->logs()->create([
            'wallet_name' => $this->type->value,
            'from' => $currentBalance,
            'to' => $newBalance,
            'type' => $logType,
            'ip' => \Request::ip(),
            'value' => $value,
            'detail' => $detail,
            'reference' => $reference
        ]);

        $this->createdLog->changeStatus('Done');
    }
}
