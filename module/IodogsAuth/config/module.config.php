<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'AuthServiceFactory' => 'IodogsAuth\Service\Factory\AuthServiceFactory',
        ),
        'invokables' => array(
            'AclService' => 'IodogsAuth\Service\AclService'
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'AuthControllerFactory' => 'IodogsAuth\Controller\Factory\AuthControllerFactory'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'router' => array(
        'routes' => array(
            'login' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/login',
                    'defaults' => array(
                        'controller' => 'AuthControllerFactory',
                        'action' => 'login'
                    ),
                ),
            ),
        ),
    ),
);