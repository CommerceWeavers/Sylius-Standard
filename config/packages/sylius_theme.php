<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('sylius_theme', [
        'sources' => [
            'filesystem' => [
                'scan_depth' => 1,
                'directories' => [
                    '%kernel.project_dir%/themes',
                ],
            ],
        ],
    ]);
    if ($containerConfigurator->env() === 'test') {
        $containerConfigurator->extension('sylius_theme', [
            'sources' => [
                'test' => null,
            ],
        ]);
    }
    if ($containerConfigurator->env() === 'test_cached') {
        $containerConfigurator->extension('sylius_theme', [
            'sources' => [
                'test' => null,
            ],
        ]);
    }
};
