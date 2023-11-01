<?php

namespace Doekos\LaravelHexagon\Handlers;

use Illuminate\Contracts\Container\BindingResolutionException;

trait WithDomain
{
    /**
     * @return DomainHelper
     * @throws BindingResolutionException
     */
    public function helper(): DomainHelper
    {
        return app()->make(DomainHelper::class);
    }
}