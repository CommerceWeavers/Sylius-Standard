<?php

declare(strict_types=1);

use Doctrine\Common\Cache\Psr6\DoctrineProvider;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set('env(DATABASE_URL)', '');

    $containerConfigurator->extension('doctrine', [
        'dbal' => [
            'url' => '%env(resolve:DATABASE_URL)%',
        ],
        'orm' => [
            'auto_generate_proxy_classes' => '%kernel.debug%',
            'entity_managers' => [
                'default' => [
                    'auto_mapping' => true,
                    'mappings' => [
                        'App' => [
                            'is_bundle' => false,
                            'type' => 'attribute',
                            'dir' => '%kernel.project_dir%/src/Entity',
                            'prefix' => 'App\Entity',
                            'alias' => 'App',
                        ],
                    ],
                ],
            ],
        ],
    ]);
    if ($containerConfigurator->env() === 'prod') {
        $containerConfigurator->extension('doctrine', [
            'orm' => [
                'entity_managers' => [
                    'default' => [
                        'metadata_cache_driver' => [
                            'type' => 'service',
                            'id' => 'doctrine.system_cache_provider',
                        ],
                        'query_cache_driver' => [
                            'type' => 'service',
                            'id' => 'doctrine.system_cache_provider',
                        ],
                        'result_cache_driver' => [
                            'type' => 'service',
                            'id' => 'doctrine.result_cache_provider',
                        ],
                    ],
                ],
            ],
        ]);
        $containerConfigurator->extension('services', [
            'doctrine.result_cache_provider' => [
                'class' => DoctrineProvider::class,
                'public' => false,
                'factory' => [
                    DoctrineProvider::class,
                    'wrap',
                ],
                'arguments' => [
                    service('doctrine.result_cache_pool'),
                ],
            ],
            'doctrine.system_cache_provider' => [
                'class' => DoctrineProvider::class,
                'public' => false,
                'factory' => [
                    DoctrineProvider::class,
                    'wrap',
                ],
                'arguments' => [
                    service('doctrine.system_cache_pool'),
                ],
            ],
        ]);
        $containerConfigurator->extension('framework', [
            'cache' => [
                'pools' => [
                    'doctrine.result_cache_pool' => [
                        'adapter' => 'cache.app',
                    ],
                    'doctrine.system_cache_pool' => [
                        'adapter' => 'cache.system',
                    ],
                ],
            ],
        ]);
    }
    if ($containerConfigurator->env() === 'test_cached') {
        $containerConfigurator->extension('doctrine', [
            'orm' => [
                'entity_managers' => [
                    'default' => [
                        'metadata_cache_driver' => [
                            'type' => 'service',
                            'id' => 'doctrine.system_cache_provider',
                        ],
                        'query_cache_driver' => [
                            'type' => 'service',
                            'id' => 'doctrine.system_cache_provider',
                        ],
                        'result_cache_driver' => [
                            'type' => 'service',
                            'id' => 'doctrine.result_cache_provider',
                        ],
                    ],
                ],
            ],
        ]);
        $containerConfigurator->extension('services', [
            'doctrine.result_cache_provider' => [
                'class' => DoctrineProvider::class,
                'public' => false,
                'factory' => [
                    DoctrineProvider::class,
                    'wrap',
                ],
                'arguments' => [
                    service('doctrine.result_cache_pool'),
                ],
            ],
            'doctrine.system_cache_provider' => [
                'class' => DoctrineProvider::class,
                'public' => false,
                'factory' => [
                    DoctrineProvider::class,
                    'wrap',
                ],
                'arguments' => [
                    service('doctrine.system_cache_pool'),
                ],
            ],
        ]);
        $containerConfigurator->extension('framework', [
            'cache' => [
                'pools' => [
                    'doctrine.result_cache_pool' => [
                        'adapter' => 'cache.app',
                    ],
                    'doctrine.system_cache_pool' => [
                        'adapter' => 'cache.system',
                    ],
                ],
            ],
        ]);
    }
};
