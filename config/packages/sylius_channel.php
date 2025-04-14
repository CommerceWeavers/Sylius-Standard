<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    if ($containerConfigurator->env() === 'test_cached') {
        $containerConfigurator->extension('sylius_channel', [
            'debug' => true,
        ]);
    }
};
