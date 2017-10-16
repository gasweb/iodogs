<?php
namespace IodogsCatalog;

use IodogsCatalog\Controller\CategoryAdminController,
    IodogsCatalog\Controller\Factory\CategoryAdminControllerFactory,
    IodogsCatalog\Controller\LineAdminController,
    IodogsCatalog\Controller\Factory\LineAdminControllerFactory,
    IodogsCatalog\Controller\SolutionAdminController,
    IodogsCatalog\Controller\Factory\SolutionAdminControllerFactory,
    IodogsCatalog\Service\CatalogService,
    IodogsCatalog\Controller\Factory\CatalogControllerFactory,
    IodogsCatalog\Controller\CatalogController,
    IodogsCatalog\Controller\LineController,
    IodogsCatalog\Controller\Factory\LineControllerFactory,
    IodogsCatalog\Controller\SolutionController,
    IodogsCatalog\Controller\Factory\SolutionControllerFactory,
    IodogsCatalog\Service\LineService,
    IodogsCatalog\Service\Factory\LineServiceFactory,
    IodogsCatalog\Service\SolutionService,
    IodogsCatalog\Service\Factory\SolutionServiceFactory;
use IodogsCatalog\Service\Factory\CatalogServiceFactory;

return [
    'controllers' => [
        'factories' => [
            CatalogController::class => CatalogControllerFactory::class,
            CategoryAdminController::class => CategoryAdminControllerFactory::class,
            LineAdminController::class => LineAdminControllerFactory::class,
            LineController::class => LineControllerFactory::class,
            SolutionAdminController::class => SolutionAdminControllerFactory::class,
            SolutionController::class => SolutionControllerFactory::class,
        ],

    ],
    'service_manager' => [
       'factories' => [
           CatalogService::class => CatalogServiceFactory::class,
           LineService::class => LineServiceFactory::class,
           SolutionService::class => SolutionServiceFactory::class
       ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
