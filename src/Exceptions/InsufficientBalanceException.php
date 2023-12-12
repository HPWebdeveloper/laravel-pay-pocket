<?php

namespace HPWebdeveloper\LaravelPayPocket\Exceptions;

use Exception;

class InsufficientBalanceException extends Exception
{
    /**
     * Construct the exception.
     *
     * @param  string  $message
     * @param  int  $code
     */
    public function __construct($message = 'Insufficient balance to cover the order', $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
