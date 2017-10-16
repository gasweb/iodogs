<?php
namespace IodogsCatalog;

use IodogsCatalog\Controller\CategoryAdminController,
    IodogsCatalog\Controller\Factory\CategoryAdminControllerFactory,
    IodogsCatalog\Controller\LineAdminController,
    IodogsCatalog\Controller\Factory\LineAdminControllerFactory,
    IodogsCatalog\Controller\SolutionAdminController,
    IodogsCatalog\Controller\Factory\SolutionAdminControllerFactory,
    IodogsCatalog\Service\CatalogService,
    IodogsCatalog\Controller\Factory\CatalogControllerFactory;
use IodogsCatalog\Service\Factory\CatalogServiceFactory;

return [
    'controllers' => [
        'factories' => [
            'CatalogControllerFactory' => 'IodogsCatalog\Controller\Factory\CatalogControllerFactory',
            CategoryAdminController::class => CategoryAdminControllerFactory::class,
            'CategoryAdminControllerFactory' => 'IodogsCatalog\Controller\Factory\CategoryAdminControllerFactory',
            LineAdminController::class => LineAdminControllerFactory::class,
            'LineAdminControllerFactory' => 'IodogsCatalog\Controller\Factory\LineAdminControllerFactory',
            'SolutionAdminControllerFactory' => 'IodogsCatalog\Controller\Factory\SolutionAdminControllerFactory',
            SolutionAdminController::class => SolutionAdminControllerFactory::class,
            'SolutionControllerFactory' => 'IodogsCatalog\Controller\Factory\SolutionControllerFactory',
        ],

    ],
    'service_manager' => [
   'factories' => [
       CatalogService::class => CatalogServiceFactory::class,
            'LineServiceFactory' => 'IodogsCatalog\Service\Factory\LineServiceFactory',
            'SolutionServiceFactory' => 'IodogsCatalog\Service\Factory\SolutionServiceFactory',

   ],
   'invokables' => [
            'CategoryService' => 'IodogsCatalog\Service\CategoryService',
            'LineService' => 'IodogsCatalog\Service\LineService'],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'view_helpers' => [
    'invokables' => [

    ],
    'factories' => [

    ]
    ],
];
