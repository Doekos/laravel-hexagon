<?php

namespace Doekos\LaravelHexagon\Console;

use Doekos\LaravelHexagon\Handlers\WithDomain;
use Exception;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class MakeDomainCommand extends Command
{
    use WithDomain;

    protected $signature = 'hexagon:domain {domain}';
    protected $description = 'Creates a domain directory with subdirectories and files';
    protected function getStub(){}

    public function handle(): int
    {
        try {
            $domainName = $this->argument('domain');

            $domainsDir = $this->helper()->getDomainsDir();

            $this->helper()->makeNewDomainDir($domainName, $domainsDir);

            $this->output->success('Domain '. $domainName . ' created successfully.');
            return 0;
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }
    }
}