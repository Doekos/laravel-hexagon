<?php

namespace Doekos\LaravelHexagon\Tests;

use Doekos\LaravelHexagon\LaravelHexagonServiceProvider;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * Get package providers.
     *
     * @param  Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            LaravelHexagonServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  Application   $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        //
    }
}