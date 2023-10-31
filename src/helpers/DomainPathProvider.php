<?php

namespace Doekos\LaravelHexagon\helpers;

class DomainPathProvider
{
    public static function getDomainPaths(): array
    {
        if (!file_exists(base_path('app/Domain'))) {
            return [];
        };

        $domains = array_diff(scandir(base_path('app/Domain')), array('.', '..'));

        $domainPaths = [];
        foreach($domains as $domain) {
            if (!is_dir($domain)) {
                continue;
            }

            $domainPaths[] = 'app/Domain/' . $domain;
        }

        return $domainPaths;
    }
}