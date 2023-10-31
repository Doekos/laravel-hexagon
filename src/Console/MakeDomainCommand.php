<?php

namespace Doekos\LaravelHexagon\Console;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeDomainCommand extends Command
{
    protected $name = 'hexagon:domain';
    protected $description = 'Command description';
    protected function getStub(){}

    public function handle(): int
    {
        try {
            $domain = $this->argument('domain');

            $domainsDir = $this->getDomainsDir();

            $this->makeNewDomainDir($domain, $domainsDir);

            $this->info($domainsDir);
            return 0;
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }
    }

    private function getAppDir(): string
    {
        for ($i = 1; $i <= 10; $i++) {
            $appDir = dirname(__DIR__, $i) . '/app';

            $appDirExists = file_exists($appDir);

            if ($appDirExists) {
                break;
            }
        }

        if (!$appDirExists) {
            throw new Exception('Could not find app directory! Command must be with in subdirectory of app');
        }

        return $appDir;
    }

    private function getDomainsDir(): string
    {
        $appDir = $this->getAppDir();

        $domainDir = $appDir . '/Domain';
        $domainDirExists = file_exists($domainDir);

        if (!$domainDirExists) {
            mkdir($domainDir);
        }

        return $domainDir;
    }

    /**
     * @throws Exception
     */
    private function makeNewDomainDir(string $domain, string $domainsDir)
    {
        $newDomainDir = $domainsDir . '/' . $domain;
        $alreadyExists = file_exists($newDomainDir);

        if ($alreadyExists) {
            throw new Exception($domain . ' domain already exists! Will not overwrite existing domain.');
        }

        mkdir($newDomainDir);

        $folders = [
            'Actions',
            'Controllers',
            'Events',
            'Exceptions',
            'Listeners',
            'Models',
            'Requests',
            'routes',
            'Rules',
        ];

        foreach ($folders as $folder) {
            $newFolder = $newDomainDir . '/' . $folder;
            mkdir($newFolder, 0777, true);
        }

        $this->createModel();

        return true;
    }

    /**
     * @throws Exception
     */
    protected function createModel()
    {
        $domain = Str::studly(class_basename($this->argument('domain')));

        $routesOptions = $this->getRoutesOptions($domain);

        $this->call('hexagon:route', $routesOptions);
    }

    protected function getRoutesOptions(string $domain): array
    {
        return [
            'name' => $domain,
            'domain' => $domain,
        ];
    }
}