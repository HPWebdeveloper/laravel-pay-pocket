<?php

namespace HPWebdeveloper\LaravelPayPocket\Exceptions;

use Exception;
use Throwable;

class InvalidValueException extends Exception
{
    public function __construct(string $message = 'Invalie value to deposit', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
