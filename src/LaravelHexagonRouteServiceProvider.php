<?php

namespace Doekos\LaravelHexagon;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaravelHexagonRouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();
        $this->registerDomainRoutes();
    }

    public function registerDomainRoutes()
    {
        if (!file_exists(base_path('app/Domain'))) {
            return;
        };

        $domains = array_diff(scandir(base_path('app/Domain')), array('.', '..'));

        foreach ($domains as $domain) {
            $dirPath = base_path('app/Domain/') . $domain;

            if (!is_dir($dirPath)) {
                continue;
            }

            $dirs = array_diff(scandir(base_path('app/Domain/' . $domain)), array('.', '..'));
            $routesDirExists = in_array('routes', $dirs);
            if (!$routesDirExists) {
                continue;
            }

            $domainRouteFiles = array_diff(scandir(base_path('app/Domain/' . $domain . '/routes')), array('.', '..'));
            foreach ($domainRouteFiles as $file) {
                Route::namespace($this->namespace)
                    ->group(base_path('app/Domain/' . $domain . '/routes/' . $file));
            }
        }
    }
}