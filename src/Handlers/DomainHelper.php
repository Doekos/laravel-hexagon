<?php

namespace Doekos\LaravelHexagon\Handlers;

use Exception;

class DomainHelper
{
    /**
     * @throws Exception
     */
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

    public function getDomainsDir(): string
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
    public function makeNewDomainDir(string $domain, string $domainsDir): bool
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

        return true;
    }
}