<?php

declare(strict_types=1);

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->defaults()
        ->autowire()
        ->autoconfigure();

    $services->instanceof(ResourceController::class)
        ->autowire(false);

    $services->instanceof(AbstractResourceType::class)
        ->autowire(false);

    $services->load('App\\', __DIR__ . '/../src/*')
        ->exclude([
        __DIR__ . '/../src/{Entity,Kernel.php}',
    ]);

    $services->load('App\Controller\\', __DIR__ . '/../src/Controller')
        ->tag('controller.service_arguments');
};
