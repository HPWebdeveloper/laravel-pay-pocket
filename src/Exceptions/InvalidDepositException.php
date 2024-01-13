<?php

namespace HPWebdeveloper\LaravelPayPocket\Exceptions;

use Exception;
use Throwable;

class InvalidDepositException extends Exception
{
    public function __construct(string $message = 'Invalid deposit operation', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
