<?php
namespace IodogsProduct;

use IodogsProduct\Controller\Factory\ProductAdminControllerFactory,
    IodogsProduct\Controller\ProductAdminController,
    IodogsProduct\Controller\Factory\AdminProductImageControllerFactory,
    IodogsProduct\Controller\AdminProductImageController,
    IodogsProduct\Service\ProductService,
    IodogsProduct\Service\Factory\ProductServiceFactory,
    IodogsProduct\Controller\ProductController,
    IodogsProduct\Controller\Factory\ProductControllerFactory,
    IodogsProduct\View\Helper\ProductHelper,
    Zend\ServiceManager\Factory\InvokableFactory;

return [
		'controllers' => [
			'factories' => [
                ProductAdminController::class => ProductAdminControllerFactory::class,
                AdminProductImageController::class => AdminProductImageControllerFactory::class,
				ProductController::class => ProductControllerFactory::class,
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
	     ProductHelper::class => InvokableFactory::class
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