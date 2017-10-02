<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'ReviewServiceFactory' => 'IodogsReview\Service\Factory\ReviewServiceFactory'
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'ReviewControllerFactory' => 'IodogsReview\Controller\Factory\ReviewControllerFactory'
        ),
    ),
    'router' => array(
        'routes' => array(
            'review-add' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/review/add',
                    'defaults' => array(
                        'controller' => 'ReviewControllerFactory',
                        'action' => 'add'
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);