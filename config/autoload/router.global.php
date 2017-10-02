<?php
return array(
    'router' => array(
        'routes' => array(
            'region-subdomain' => array(
                'type' => 'Hostname',
                'options' => array(
                    'route' => '[:sub].isleofdogs.ru',
                    'constraint' => array(
                        'sub' => '([a-zA-Z0-9-]+)',
                    ),
                    'defaults' => array(
                        'controller' => 'ContentControllerFactory',
                        'action' => 'region'
                    ),
                ),
                'child_routes' => array(
                    'region-page' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/',
                            'defaults' => array(
                                'controller' => 'ContentControllerFactory',
                                'action' => 'region'
                            ),
                        ),
                    ),
                ),
            ),
            'app' => array(
                'type' => 'Hostname',
                'options' => array(
                    'route' => 'www.isleofdogs.ru',
                ),
//                'child_routes' => array(),
            ),
        ),
    ),
);