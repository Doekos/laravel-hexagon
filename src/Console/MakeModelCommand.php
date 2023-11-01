<?php

namespace Doekos\LaravelHexagon\Console;

use Illuminate\Console\Command;

class MakeModelCommand extends Command
{
    protected $name = 'hexagon:model {name}';
    protected $description = 'Create a new model class';
    protected $type = 'Model';
    protected $domain;

    public function handle()
    {
        $this->domain = $this->argument('name');
    }

    protected function buildClass($name)
    {
        $modelNamespace = $this->getNamespace($name);

        $replace = [
            '{{ namespace }}' => $modelNamespace,
            '{{ class }}' => $this->argument('name'),
        ];

        return str_replace(
            array_keys($replace),
            array_values($replace),
            parent::buildClass($name)
        );
    }

    protected function getStub()
    {
        return __DIR__ . '/stubs/model.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Models';
    }
}