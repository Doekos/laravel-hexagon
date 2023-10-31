<?php

namespace Doekos\LaravelHexagon\Console;

use Illuminate\Console\GeneratorCommand;

class MakeRouteCommand extends GeneratorCommand
{

    protected function getStub()
    {
        $stub = "/stubs/routes.stub";

        return $this->resolveStubPath($stub);
    }

    protected function resolveStubPath($stub): string
    {
        $localPath = __DIR__ . '/..' . $stub;
        $publishedPath = $this->laravel->basePath(trim($stub, '/'));
        return file_exists($publishedPath)
            ? $publishedPath
            : $localPath;
    }
}