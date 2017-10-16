<?php
namespace IodogsReview;

use IodogsReview\Service\ReviewService,
    IodogsReview\Service\Factory\ReviewServiceFactory,
    IodogsReview\Controller\ReviewController,
    IodogsReview\Controller\Factory\ReviewControllerFactory;
use Zend\Router\Http\Literal;

return [
    'service_manager' => [
        'factories' => [
            ReviewService::class => ReviewServiceFactory::class
        ],
    ],
    'controllers' => [
        'factories' => [
            ReviewController::class => ReviewControllerFactory::class
        ],
    ],
    'router' => [
        'routes' => [
            'review-add' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/review/add',
                    'defaults' => [
                        'controller' => ReviewController::class,
                        'action' => 'add'
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];