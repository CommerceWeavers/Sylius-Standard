<?php

declare(strict_types=1);

use Sylius\Behat\Service\Generator\UploadedImagePathGenerator;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    if ($containerConfigurator->env() === 'test') {
        $containerConfigurator->extension('services', [
            'sylius.generator.image_path' => [
                'class' => UploadedImagePathGenerator::class,
            ],
        ]);
    }
    if ($containerConfigurator->env() === 'test_cached') {
        $containerConfigurator->extension('services', [
            'sylius.generator.image_path' => [
                'class' => UploadedImagePathGenerator::class,
            ],
        ]);
    }
};
