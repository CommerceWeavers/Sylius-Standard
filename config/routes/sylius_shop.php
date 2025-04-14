<?php

declare(strict_types=1);

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return static function (RoutingConfigurator $routingConfigurator): void {
    $routingConfigurator->import('@SyliusShopBundle/Resources/config/routing.yml')
        ->prefix('/{_locale}')
        ->requirements([
        '_locale' => '^[A-Za-z]{2,4}(_([A-Za-z]{4}|[0-9]{3}))?(_([A-Za-z]{2}|[0-9]{3}))?$',
    ]);

    $routingConfigurator->import('@SyliusPayumBundle/Resources/config/routing/integrations/sylius_shop.yaml');

    $routingConfigurator->import('@SyliusPaymentBundle/Resources/config/routing/integrations/sylius.yaml');

    $routingConfigurator->add('sylius_shop_default_locale', '/')
        ->controller([
        'sylius_shop.controller.locale_switch',
        'switchAction',
    ])
        ->methods([
        'GET',
    ]);

    $routingConfigurator->add('sylius_shop_request_password_reset_token_redirect', '/.well-known/change-password')
        ->controller('Symfony\Bundle\FrameworkBundle\Controller\RedirectController::redirectAction')
        ->defaults([
        'route' => 'sylius_shop_request_password_reset_token',
        'permanent' => false,
    ])
        ->methods([
        'GET',
    ]);
};
