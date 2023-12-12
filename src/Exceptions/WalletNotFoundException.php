<?php

namespace HPWebdeveloper\LaravelPayPocket\Exceptions;

use Exception;

class WalletNotFoundException extends Exception
{
    public function __construct($message = 'Wallet not found', $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
