<?php

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routingConfigurator): void {
    if ($routingConfigurator->env() === 'test') {
        $routingConfigurator->add('sylius_test_plugin_main', '/test/main')
        ->controller('Symfony\Bundle\FrameworkBundle\Controller\TemplateController::templateAction')
        ->defaults([
            'template' => '@SyliusTestPlugin/main.html.twig',
        ]);
    }
    if ($routingConfigurator->env() === 'test_cached') {
        $routingConfigurator->add('sylius_test_plugin_main', '/test/main')
        ->controller('Symfony\Bundle\FrameworkBundle\Controller\TemplateController::templateAction')
        ->defaults([
            'template' => '@SyliusTestPlugin/main.html.twig',
        ]);
    }
};
