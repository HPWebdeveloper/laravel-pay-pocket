<?php

namespace HPWebdeveloper\LaravelPayPocket\Exceptions;

use Exception;
use Throwable;

class WalletNotFoundException extends Exception
{
    public function __construct(string $message = 'Wallet not found', int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
