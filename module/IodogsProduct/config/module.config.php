<?php

use IodogsProduct\Controller\Factory\ProductAdminControllerFactory,
    IodogsProduct\Controller\ProductAdminController,
    IodogsProduct\Controller\Factory\AdminProductImageControllerFactory,
    IodogsProduct\Controller\AdminProductImageController;

return [
		'controllers' => [
			'factories' => [
                ProductAdminController::class => ProductAdminControllerFactory::class,
                AdminProductImageController::class => AdminProductImageControllerFactory::class,
				'ProductControllerFactory' => 'IodogsProduct\Controller\Factory\ProductControllerFactory',
            ],
        ],
	    'service_manager' => [
		   'factories' => [
		   	'ProductServiceFactory' => 'IodogsProduct\Service\Factory\ProductServiceFactory',
           ],
		   'invokables' => [

           ],
        ],
	'view_helpers' => [
	    'invokables' => [
	     'ProductHelper' => 'IodogsProduct\View\Helper\ProductHelper'
        ],
    ],
	'router' => [
		'routes' => [

        ],
    ],
	'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];