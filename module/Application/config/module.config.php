<?php

namespace Application;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => \Zend\Mvc\Router\Http\Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\Index::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/application',
                    'defaults' => [
                        'controller' => Controller\Index::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'default' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults' => [
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
            \Zend\Cache\Service\StorageCacheAbstractServiceFactory::class,
            \Zend\Log\LoggerAbstractServiceFactory::class,
        ],
        'factories' => [
            'translator' => \Zend\Mvc\Service\TranslatorServiceFactory::class,
        ],
    ],
    'translator' => [
        'locale' => 'en_US',
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            Controller\Index::class => Controller\IndexController::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.twig',
            'application/index/index' => __DIR__ . '/../view/application/index/index.twig',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
            'ZfcTwigViewStrategy',
        ],
    ],
    'zfctwig' => [
        'extensions' => [
            \Twig_Extension_Debug::class,
        ],
        'environment_options' => [
            'debug' => true
        ],
    ],
    // Placeholder for console routes
    'console' => [
        'router' => [
            'routes' => [
            ],
        ],
    ],
];