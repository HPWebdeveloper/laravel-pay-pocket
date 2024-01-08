<?php

namespace HPWebdeveloper\LaravelPayPocket\Exceptions;

use Exception;

class InvalidDepositException extends Exception
{
    /**
     * Construct the exception.
     *
     * @param  string  $message
     * @param  int  $code
     */
    public function __construct($message = 'Invalid deposit operation', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
