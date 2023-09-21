<?php

namespace Laravel\Cashier\Tests;

use Illuminate\Support\Str;
use InvalidArgumentException;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Tests\Fixtures\User;
use Orchestra\Testbench\Concerns\WithLaravelMigrations;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

abstract class TestCase extends OrchestraTestCase
{
    use WithLaravelMigrations, WithWorkbench;

    protected function defineEnvironment($app)
    {
        $apiKey = $app['config']->get('cashier.secret');

        if ($apiKey && ! Str::startsWith($apiKey, 'sk_test_')) {
            throw new InvalidArgumentException('Tests may not be run with a production Stripe key.');
        }

        Cashier::useCustomerModel(User::class);
    }
}
