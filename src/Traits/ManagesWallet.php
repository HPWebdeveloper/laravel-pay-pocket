<?php

namespace HPWebdeveloper\LaravelPayPocket\Traits;

trait ManagesWallet
{
    use HandlesDeposit, HandlesPayment, HasWallet;
}
