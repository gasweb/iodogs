<?php
namespace IodogsAuth;

use IodogsAuth\Service\AclService,
    IodogsAuth\Service\Factory\AclServiceFactory,
    IodogsAuth\Service\AuthService,
    IodogsAuth\Service\Factory\AuthServiceFactory,
    Zend\ServiceManager\Factory\InvokableFactory,
    IodogsAuth\Controller\Factory\AuthControllerFactory,
    IodogsAuth\Controller\AuthController;
return [
    'service_manager' => [
        'factories' => [
            AuthService::class => AuthServiceFactory::class,
            AclService::class => AclServiceFactory::class
        ],
    ],
    'controllers' => [
        'factories' => [
            AuthController::class => AuthControllerFactory::class
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'router' => [
        'routes' => [
            'login' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/login',
                    'defaults' => [
                        'cache' => false,
                        'controller' => AuthController::class,
                        'action' => 'login'
                    ],
                ],
            ],
        ],
    ],
];