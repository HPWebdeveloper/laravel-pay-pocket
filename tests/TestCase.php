<?php

namespace HPWebdeveloper\LaravelPayPocket\Tests;

use HPWebdeveloper\LaravelPayPocket\LaravelPayPocketServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    public function getEnvironmentSetUp($app)
    {
        config()->set('app.key', 'base64:EWcFBKBT8lKlGK8nQhTHY+wg19QlfmbhtO9Qnn3NfcA=');

        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-pay-pocket_table.php.stub';
        $migration->up();
        */

        $migration = include __DIR__.'/database/migrations/create_users_tables.php';
        $migration->up();

        $migration = include __DIR__.'/../database/migrations/create_wallets_logs_table.php.stub';
        $migration->up();

        $migration = include __DIR__.'/../database/migrations/create_wallets_table.php.stub';
        $migration->up();

        $migration = include __DIR__.'/../database/migrations/add_notes_and_reference_columns_to_wallets_logs_table.php.stub';
        $migration->up();
    }

    protected function setUp(): void
    {
        parent::setUp();

        /*
        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'HPWebdeveloper\\LaravelPayPocket\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
        */

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'HPWebdeveloper\\LaravelPayPocket\\Tests\\Database\\Factories\\'.class_basename(
                $modelName
            ).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelPayPocketServiceProvider::class,
        ];
    }
}
