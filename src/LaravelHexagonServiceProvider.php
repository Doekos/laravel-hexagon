<?php

namespace Doekos\LaravelHexagon;

use Illuminate\Support\ServiceProvider;
use Doekos\LaravelHexagon\Console\MakeDomainCommand;

class LaravelHexagonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeDomainCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/stubs/routes.stub' => base_path('stubs/routes.stub')
        ], 'domain-stubs');
    }
}