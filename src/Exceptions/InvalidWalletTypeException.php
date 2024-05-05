<?php

namespace HPWebdeveloper\LaravelPayPocket\Exceptions;

use Exception;
use Throwable;

class InvalidWalletTypeException extends Exception
{
    public function __construct(string $message = 'Invalid wallet type', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
