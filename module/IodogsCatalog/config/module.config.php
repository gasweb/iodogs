<?php
return array(
    'controllers' => array(
        /*'invokables' => array(
            'IodogsCatalog\Controller\Catalog' => 'IodogsCatalog\Controller\CatalogController'            
        ),*/
        'factories' => array(
            'CatalogControllerFactory' => 'IodogsCatalog\Controller\Factory\CatalogControllerFactory',
            'CategoryAdminControllerFactory' => 'IodogsCatalog\Controller\Factory\CategoryAdminControllerFactory',
            'LineControllerFactory' => 'IodogsCatalog\Controller\Factory\LineControllerFactory',
            'LineAdminControllerFactory' => 'IodogsCatalog\Controller\Factory\LineAdminControllerFactory',
            'SolutionAdminControllerFactory' => 'IodogsCatalog\Controller\Factory\SolutionAdminControllerFactory',
            'SolutionControllerFactory' => 'IodogsCatalog\Controller\Factory\SolutionControllerFactory',

            ),

    ),    
    'service_manager' => array(
   'factories' => array(
            'CatalogServiceFactory' => 'IodogsCatalog\Service\Factory\CatalogServiceFactory',
            'LineServiceFactory' => 'IodogsCatalog\Service\Factory\LineServiceFactory',
            'SolutionServiceFactory' => 'IodogsCatalog\Service\Factory\SolutionServiceFactory',

            ),
   'invokables' => array(            
            'CategoryService' => 'IodogsCatalog\Service\CategoryService',
            'LineService' => 'IodogsCatalog\Service\LineService'),
),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ), 
    'view_helpers' => array(
    'invokables' => array(       
        
    ),
    'factories' => array(
        
        )
    ),
);
