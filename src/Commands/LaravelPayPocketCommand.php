<?php

namespace HPWebdeveloper\LaravelPayPocket\Commands;

use Illuminate\Console\Command;

class LaravelPayPocketCommand extends Command
{
    public $signature = 'laravel-pay-pocket';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
