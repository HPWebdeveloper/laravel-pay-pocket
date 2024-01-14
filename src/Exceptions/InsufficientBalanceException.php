<?php

namespace HPWebdeveloper\LaravelPayPocket\Exceptions;

use Exception;
use Throwable;

class InsufficientBalanceException extends Exception
{
    public function __construct(string $message = 'Insufficient balance to cover the order', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
