<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('doctrine_migrations', [
        'storage' => [
            'table_storage' => [
                'table_name' => 'sylius_migrations',
            ],
        ],
        'migrations_paths' => [
            'App' => '%kernel.project_dir%/migrations',
        ],
        'enable_profiler' => false,
    ]);
};
