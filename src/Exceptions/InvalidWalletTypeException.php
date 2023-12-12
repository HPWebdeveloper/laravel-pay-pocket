<?php

namespace HPWebdeveloper\LaravelPayPocket\Exceptions;

use Exception;

class InvalidWalletTypeException extends Exception
{
    public function __construct($message = 'Invalid wallet type', $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
