<?php

namespace HPWebdeveloper\LaravelPayPocket;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelPayPocketServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-pay-pocket')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations('create_wallets_logs_table', 'create_wallets_table');
    }

    public function bootingPackage()
    {
        $this->publishes([
            __DIR__.'/../Enums/' => app_path('Enums'),
        ], 'pay-pocket-wallets');
    }
}
