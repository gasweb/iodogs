<?php
namespace IodogsReview;

use IodogsReview\Controller\BackofficeController;
use IodogsReview\Service\ReviewService,
    IodogsReview\Service\Factory\ReviewServiceFactory,
    IodogsReview\Controller\ApplicationController,
    IodogsReview\Controller\Factory\ControllerFactory;
use Zend\Router\Http\Literal;

return [
    'service_manager' => [
        'factories' => [
            ReviewService::class => ReviewServiceFactory::class
        ],
    ],
    'controllers' => [
        'factories' => [
            ApplicationController::class => ControllerFactory::class,
            BackofficeController::class => ControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'app' => [
                'child_routes' => [
                    'application-add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/review/add',
                            'defaults' => [
                                'controller' => ApplicationController::class,
                                'action' => 'add'
                            ],
                        ],
                    ],
                ]
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];