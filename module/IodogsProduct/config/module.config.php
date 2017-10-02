<?php
return array(
		'controllers' => array(
			'factories' => array(
				'ProductControllerFactory' => 'IodogsProduct\Controller\Factory\ProductControllerFactory',
				'ProductAdminControllerFactory' => 'IodogsProduct\Controller\Factory\ProductAdminControllerFactory',
                'AdminProductImageControllerFactory' => 'IodogsProduct\Controller\Factory\AdminProductImageControllerFactory'
				),
			),
	    'service_manager' => array(
		   'factories' => array(
		   	'ProductServiceFactory' => 'IodogsProduct\Service\Factory\ProductServiceFactory',
		   	),
		   'invokables' => array(            
		            /*'ProductService' => 'IodogsProduct\Service\ProductService',*/	
	),  
),  
	'view_helpers' => array(
	    'invokables' => array(       
	     'ProductHelper' => 'IodogsProduct\View\Helper\ProductHelper'   
	    ),
	), 
	'router' => array(
		'routes' => array(
				/*'product' => array(
                'type'    => 'segment',
                    'options' => array(
                        'route'    => '/item/[:slug]',
                        'constraints' => array(
                            'id' => '[0-9A-Za-z]+',
                            ),                            
                        'defaults' => array(
                            'controller' => 'ProductControllerFactory',
                            'action'     => 'index',
                        ),
                    ),          
            	),
            	'admin-product' =>array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/product',
                    'defaults' => array(                        
                        'controller' => 'ProductAdminControllerFactory',
                        'action' => 'show',
                        ),
                    ),
                'may_terminate' => true,
                'child_routes' => array(
                'id' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '[:id]',
                        'constraints' => array(
                            'id' => '[0-9]+',
                            ),  
                            'defaults' => array(
                            'controller' => 'ProductAdminControllerFactory',
                            'action'     => 'edit',
                                     ),                                  
                        ),                        
                        'may_terminate' => true,
                        'child_routes' => array(
                            'breed' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route' => '/breed',
                                    'defaults' => array(
                                        'action' => 'breed'
                                    ),
                                ),
                            ),
                        'admin-product-delete' => array(
                            'type' => 'Literal',
                            'options' => array(
                                'route' => '/delete',                                
                                    'defaults' => array(
                                    'controller' => 'ProductAdminControllerFactory',
                                    'action'     => 'delete',
                                    ),                                  
                                ),
                            ),
                        ),
                    ),
                ),
              ),
            'admin-product-add' =>array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/admin/product/add',
                    'defaults' => array(                        
                        'controller' => 'ProductAdminControllerFactory',
                        'action' => 'add',
                        ),
                    ),
                ),
			'admin-product-image' =>array(
				'type' => 'Segment',
				'options' => array(
					'route' => '/admin/product[:id]/image',
					'constraints' => array(
						'id' => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'AdminProductImageControllerFactory',
						'action' => 'show',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'admin-product-image-add' => array(
						'type' => 'literal',
						'options' => array(
							'route' => '/add',
							'defaults' => array(
								'controller' => 'AdminProductImageControllerFactory',
								'action'     => 'add',
                                ),
                            ),
                        ),
                    ),
                ),*/
			),
		),
	'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);