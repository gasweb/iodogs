<?php

use IodogsProduct\Controller\Factory\ProductAdminControllerFactory,
    IodogsProduct\Controller\ProductAdminController,
    IodogsProduct\Controller\Factory\AdminProductImageControllerFactory,
    IodogsProduct\Controller\AdminProductImageController,
    IodogsProduct\Service\ProductService,
    IodogsProduct\Service\Factory\ProductServiceFactory;

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
               ProductService::class => ProductServiceFactory::class,
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