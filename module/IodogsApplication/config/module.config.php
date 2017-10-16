<?php
namespace IodogsApplication;

use IodogsApplication\Service\Cache\Application\ApplicationCacheService;
use IodogsApplication\Service\Cache\Factory\CacheServiceFactory;

//ZF3 use block
use Zend\Router\Http\Literal,
    Zend\Router\Http\Segment;

//Content use block
use IodogsApplication\Controller\AdminContentController,
    IodogsApplication\Controller\Factory\AdminContentControllerFactory,
    IodogsApplication\Controller\Factory\InfoBlockAdminControllerFactory,
    IodogsApplication\Controller\InfoBlockAdminController,
    IodogsApplication\Service\InfoBlockService,
    IodogsApplication\Service\Factory\InfoBlockServiceFactory;

//Products use block
use IodogsProduct\Controller\ProductAdminController,
    IodogsProduct\Controller\AdminProductImageController;

//Breed use block
use IodogsBreed\Controller\AdminBreedController;

//Images use block
use IodogsFiles\Controller\ImageController;

//Categories use block
use IodogsCatalog\Controller\CategoryAdminController;

//Line use block
use IodogsCatalog\Controller\LineAdminController;

//Solution use block
use IodogsCatalog\Controller\SolutionAdminController;

return [
    'controllers' => [
        'invokables' => [
            'OldApplicationController' => 'IodogsApplication\Controller\OldApplicationController',
        ],
        'factories' => [
            AdminContentController::class => AdminContentControllerFactory::class,
            'ContentControllerFactory' => 'IodogsApplication\Controller\Factory\ContentControllerFactory',
            InfoBlockAdminController::class => InfoBlockAdminControllerFactory::class,
            'SearchControllerFactory' => 'IodogsApplication\Controller\Factory\SearchControllerFactory'
        ]
    ],
    'service_manager' => [
   'factories' => [
       InfoBlockService::class => InfoBlockServiceFactory::class,
      'NavigationFactory' => 'IodogsApplication\Navigation\MenuNavigationFactory',
      'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
      'ContentServiceFactory' => 'IodogsApplication\Service\Factory\ContentServiceFactory',
      'admin-nav' => 'IodogsApplication\Navigation\Factory\AdminNavigationFactory',
      'application-nav' => 'IodogsApplication\Navigation\Factory\ApplicationNavigationFactory',
      'product-nav' => 'IodogsApplication\Navigation\Factory\ProductNavigationFactory',
      'IodogsCacheService' => 'Zend\Cache\Service\StorageCacheFactory',
       ApplicationCacheService::class => CacheServiceFactory::class,
   ],
   'invokables' => [
   ],
    ],
    'router' => [
        'routes' => [
            'region-subdomain' => [
                'type' => 'hostname',
                'options' => [
                    'defaults' => [
                        'controller' => 'ContentControllerFactory',
                        'action' => 'region'
                    ],
                ],
            ],
            'app' => [
                'child_routes' => [
                    'backoffice' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/admin/',
                            'defaults' => [
                                'cache' => false,
                                'controller' => AdminContentController::class,
                                'action' => 'index',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'content' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => 'content',
                                    'defaults' => [
                                        'controller' => AdminContentController::class,
                                        'action' => 'show',
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'add' => [
                                        'type' => Literal::class,
                                        'options' => [
                                            'route' => '/add',
                                            'defaults' => [
                                                'controller' => AdminContentController::class,
                                                'action' => 'add',
                                            ],
                                        ],
                                    ],
                                    'id' => [
                                        'type' => Segment::class,
                                        'options' => [
                                            'route' => '[:id]',
                                            'constraints' => [
                                                'id' => '[0-9]+',
                                            ],
                                            'defaults' => [
                                                'controller' => AdminContentController::class,
                                                'action'     => 'edit',
                                            ],
                                        ],
                                        'may_terminate' => true,
                                        'child_routes' => [
                                            'delete' => [
                                                'type' => Literal::class,
                                                'options' => [
                                                    'route' => '/delete',
                                                    'defaults' => [
                                                        'controller' => AdminContentController::class,
                                                        'action'     => 'delete',
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ]
                            ],
                            'info-block' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => 'info-block',
                                    'defaults' => [
                                        'controller' => InfoBlockAdminController::class,
                                        'action' => 'show',
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'add' => [
                                        'type' => 'Literal',
                                        'options' => [
                                            'route' => 'add',
                                            'defaults' => [
                                                'controller' => InfoBlockAdminController::class,
                                                'action' => 'add'
                                            ],
                                        ],
                                    ],
                                    'edit' => [
                                        'type' => 'segment',
                                        'options' => [
                                            'route' => '[:id]',
                                            'constraints' => [
                                                'id' => '[0-9]+',
                                            ],
                                            'defaults' => [
                                                'controller' => InfoBlockAdminController::class,
                                                'action'     => 'edit',
                                            ],
                                        ],
                                    ],
                                ],

                            ],
                            'breed' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => 'breed',
                                    'defaults' => [
                                        'controller' => AdminBreedController::class,
                                        'action' => 'show',
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'add' => [
                                        'type' => 'literal',
                                        'options' => [
                                            'route' => '/add',
                                            'defaults' => [
                                                'action' => 'add'
                                            ],
                                        ],
                                    ],
                                    'id' => [
                                        'type' => Segment::class,
                                        'options' => [
                                            'route' => '[:breedId]',
                                            'constraints' => [
                                                'breedId' => '[0-9]+',
                                            ],
                                            'defaults' => [
                                                'controller' => AdminBreedController::class,
                                                'action'     => 'edit',
                                            ],
                                        ],
                                        'may_terminate' => true,
                                        'child_routes' => [
                                            'product' => [
                                                'type' => Literal::class,
                                                'options' => [
                                                    'route' => '/products',
                                                    'defaults' => [
                                                        'action' => 'breed-product'
                                                    ],
                                                ],
                                            ],
                                            'delete' => [
                                                'type' => Literal::class,
                                                'options' => [
                                                    'route' => '/delete',
                                                    'defaults' => [
                                                        'controller' => AdminBreedController::class,
                                                        'action'     => 'delete',
                                                    ],
                                                ],
                                            ],
                                            'image' => [
                                                'type' => Literal::class,
                                                'options' => [
                                                    'route' => '/image',
                                                    'defaults' => [
                                                        'action' => 'imageUpload',
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            'image' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => 'image/[:id]/',
                                    'constraints' => [
                                        'id' => '[0-9]+',
                                    ],
                                    'defaults' => [
                                        'controller' => ImageController::class,
                                        'action' => 'edit'
                                    ]
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'delete' => [
                                        'type' => 'segment',
                                        'options' => [
                                            'route' => 'delete',
                                            'constraints' => [
                                                'id' => '[0-9]+',
                                            ],
                                            'defaults' => [
                                                'controller' => ImageController::class,
                                                'action' => 'delete'
                                            ]
                                        ]
                                    ],
                                    'delete-success' => [
                                        'type' => 'literal',
                                        'options' => [
                                            'route' => 'deleted',
                                            'defaults' => [
                                                'controller' => ImageController::class,
                                                'action' => 'deleteSuccess'
                                            ]
                                        ]
                                    ],
                                ],
                            ],
                            'product' => [
                                'type' => 'Literal',
                                'options' => [
                                    'route' => 'product',
                                    'defaults' => [
                                        'controller' => ProductAdminController::class,
                                        'action' => 'show',
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'add' => [
                                        'type' => 'Literal',
                                        'options' => [
                                            'route' => '/add',
                                            'defaults' => [
                                                'controller' => ProductAdminController::class,
                                                'action' => 'add',
                                            ],
                                        ],
                                    ],
                                    'id' => [
                                        'type' => 'segment',
                                        'options' => [
                                            'route' => '/[:id]',
                                            'constraints' => [
                                                'id' => '[0-9]+',
                                            ],
                                            'defaults' => [
                                                'controller' => ProductAdminController::class,
                                                'action'     => 'edit',
                                            ],
                                        ],
                                        'may_terminate' => true,
                                        'child_routes' => [
                                            'breed' => [
                                                'type' => 'literal',
                                                'options' => [
                                                    'route' => '/breed',
                                                    'defaults' => [
                                                        'action' => 'breed'
                                                    ],
                                                ],
                                            ],
                                            'image' => [
                                                'type' => 'Segment',
                                                'options' => [
                                                    'route' => '/image',
                                                    'constraints' => [
                                                        'id' => '[0-9]+',
                                                    ],
                                                    'defaults' => [
                                                        'controller' => AdminProductImageController::class,
                                                        'action' => 'show',
                                                    ],
                                                ],
                                                'may_terminate' => true,
                                                'child_routes' => [
                                                    'add' => [
                                                        'type' => 'literal',
                                                        'options' => [
                                                            'route' => '/add',
                                                            'defaults' => [
                                                                'controller' =>
                                                                    AdminProductImageController::class,
                                                                'action'     => 'add',
                                                            ],
                                                        ],
                                                    ],
                                                ],
                                            ],
                                            'delete' => [
                                                'type' => 'Literal',
                                                'options' => [
                                                    'route' => '/delete',
                                                    'defaults' => [
                                                        'controller' => ProductAdminController::class,
                                                        'action'     => 'delete',
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            'line' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => 'line',
                                    'defaults' => [
                                        'controller' => LineAdminController::class,
                                        'action' => 'show',
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'add' => [
                                        'type' => 'Literal',
                                        'options' => [
                                            'route' => '/add',
                                            'defaults' => [
                                                'controller' => LineAdminController::class,
                                                'action' => 'add',
                                            ],
                                        ],
                                    ],
                                    'id' => [
                                        'type' => Segment::class,
                                        'options' => [
                                            'route' => '/[:lineId]',
                                            'constraints' => [
                                                'lineId' => '[0-9]+',
                                            ],
                                            'defaults' => [
                                                'controller' => LineAdminController::class,
                                                'action'     => 'edit',
                                            ],
                                        ],
                                        'may_terminate' => true,
                                        'child_routes' => [
                                            'delete' => [
                                                'type' => Literal::class,
                                                'options' => [
                                                    'route' => '/delete',
                                                    'defaults' => [
                                                        'controller' => LineAdminController::class,
                                                        'action'     => 'delete',
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            'solution' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => 'solution',
                                    'defaults' => [
                                        'controller' => SolutionAdminController::class,
                                        'action' => 'show',
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'add' => [
                                        'type' => Literal::class,
                                        'options' => [
                                            'route' => '/add',
                                            'defaults' => [
                                                'controller' => SolutionAdminController::class,
                                                'action' => 'add',
                                            ],
                                        ],
                                    ],
                                    'edit' => [
                                        'type' => Segment::class,
                                        'options' => [
                                            'route' => '/[:id]',
                                            'constraints' => [
                                                'id' => '[0-9]+',
                                            ],
                                            'defaults' => [
                                                'controller' => SolutionAdminController::class,
                                                'action'     => 'edit',
                                            ],
                                        ],
                                        'may_terminate' => true,
                                        'child_routes' => [
                                            'product' => [
                                                'type' => Literal::class,
                                                'options' => [
                                                    'route' => '/product',
                                                    'defaults' => [
                                                        'controller' => SolutionAdminController::class,
                                                        'action' => 'product',
                                                    ]
                                                ],
                                            ],
                                            'delete' => [
                                                'type' => Literal::class,
                                                'options' => [
                                                    'route' => '/delete',
                                                    'defaults' => [
                                                        'controller' => SolutionAdminController::class,
                                                        'action'     => 'delete',
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            'category' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => 'category',
                                    'defaults' => [
                                        'controller' => CategoryAdminController::class,
                                        'action' => 'show',
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'add' => [
                                        'type' => Literal::class,
                                        'options' => [
                                            'route' => '/add',
                                            'defaults' => [
                                                'controller' => CategoryAdminController::class,
                                                'action' => 'add',
                                            ],
                                        ],
                                    ],
                                    'id' => [
                                        'type' => Segment::class,
                                        'options' => [
                                            'route' => '/[:id]',
                                            'constraints' => [
                                                'id' => '[0-9]+',
                                            ],
                                            'defaults' => [
                                                'controller' => CategoryAdminController::class,
                                                'action'     => 'edit',
                                            ],
                                        ],
                                        'may_terminate' => true,
                                        'child_routes' => [
                                            'delete' => [
                                                'type' => Literal::class,
                                                'options' => [
                                                    'route' => '/delete',
                                                    'defaults' => [
                                                        'controller' => CategoryAdminController::class,
                                                        'action'     => 'delete',
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ]
                    ],
                    'content' => [
                        'type'    => 'segment',
                        'options' => [
                            'route'    => '/[:slug]',
                            'constraints' => [
                                'slug' => '[a-zA-Z-_0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'ContentControllerFactory',
                                'action'     => 'slug',
                            ],
                        ],
                    ],
                    'search' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/search',
                            'defaults' => [
                                'controller' => 'SearchControllerFactory',
                                'action' => 'index'
                            ],
                        ],
                    ],
                    'home' => [
                        'type'    => 'literal',
                        'options' => [
                            'route'    => '/',
                            'defaults' => [
                                'controller' => 'ContentControllerFactory',
                                'action'     => 'home',
                            ],
                        ],
                    ],
                    'wholesale' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/wholesale',
                            'defaults' => [
                                'controller' => 'ContentControllerFactory',
                                'action' => 'wholesale'
                            ],
                        ],
                    ],
                    'buy' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/buy',
                            'defaults' => [
                                'controller' => 'ContentControllerFactory',
                                'action' => 'buy'
                            ],
                        ],
                    ],
                    'contacts' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/contacts',
                            'defaults' => [
                                'controller' => 'ContentControllerFactory',
                                'action' => 'contacts'
                            ],
                        ],
                    ],
                    'video' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/video',
                            'defaults' => [
                                'controller' => 'ContentControllerFactory',
                                'action' => 'video'
                            ],
                        ],
                    ],
                    'message-sent' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/message/sent',
                            'defaults' => [
                                'controller' => 'ContentControllerFactory',
                                'action' => 'messageSent'
                            ],
                        ],
                    ],
                    'breed' => [
                        'type'    => 'literal',
                        'options' => [
                            'route'    => '/breed/',
                            'defaults' => [
                                'controller' => 'BreedControllerFactory',
                                'action'     => 'allBreeds',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'breed-slug' => [
                                'type' => 'segment',
                                'options' => [
                                    'route' => '[:slug]',
                                    'constraints' => [
                                        'slug' => '[a-zA-Z0-9-]+',
                                    ],
                                    'defaults' => [
                                        'controller' => 'BreedControllerFactory',
                                        'action' => 'breedSlug'
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'iodogs-admin' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => '/admin/',
                            'defaults' => [
                                'controller'    => 'AdminContentController',
                                'action'        => 'index',
                            ],
                        ],
                    ],
                    'catalog' => [
                        'type'    => 'literal',
                        'options' => [
                            'route'    => '/catalog/',
                            'defaults' => [
                                'controller' => 'CatalogControllerFactory',
                                'action'     => 'category',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'category-slug' => [
                                'type' => 'segment',
                                'options' => [
                                    'route' => '[:slug]',
                                    'constraints' => [
                                        'id' => '[0-9A-Za-z]+',
                                    ],
                                    'defaults' => [
                                        'controller' => 'CatalogControllerFactory',
                                        'action'     => 'slug',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'solution' => [
                        'type'    => 'literal',
                        'options' => [
                            'route'    => '/solution/',
                            'defaults' => [
                                'controller' => 'SolutionControllerFactory',
                                'action'     => 'list',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'slug' => [
                                'type' => 'segment',
                                'options' => [
                                    'route' => '[:slug]',
                                    'constraints' => [
                                        'id' => '[0-9A-Za-z]+',
                                    ],
                                    'defaults' => [
                                        'controller' => 'SolutionControllerFactory',
                                        'action'     => 'slug',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'line' => [
                        'type'    => 'literal',
                        'options' => [
                            'route'    => '/line/',
                            'defaults' => [
                                'controller' => 'LineControllerFactory',
                                'action'     => 'lineList',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'slug' => [
                                'type' => 'segment',
                                'options' => [
                                    'route' => '[:slug]',
                                    'constraints' => [
                                        'id' => '[0-9a-zA-Z-]+',
                                    ],
                                    'defaults' => [
                                        'controller' => 'LineControllerFactory',
                                        'action'     => 'index',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'product' => [
                        'type'    => 'segment',
                        'options' => [
                            'route'    => '/item/[:slug]',
                            'constraints' => [
                                'id' => '[0-9A-Za-z]+',
                            ],
                            'defaults' => [
                                'controller' => 'ProductControllerFactory',
                                'action'     => 'index',
                            ],
                        ],
                    ],
                'old_product' => [
                    'type' => 'segment',
                    'options' => [
                        'route' => '/product[:id]',
                        'constraints' => [
                            'id' => '[0-9]+'
                        ],
                        'defaults' => [
                            'controller' => 'OldApplicationController',
                            'action' => 'product'
                        ],
                    ],
                ],
                    'old_breed' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/breed[:id]',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                'controller' => 'OldApplicationController',
                                'action' => 'breed'
                            ],
                        ],
                    ],
                    'old_catalog' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/category[:id]',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                'controller' => 'OldApplicationController',
                                'action' => 'category'
                            ],
                        ],
                    ],
                    'breed-default' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/breed',
                            'defaults' => [
                                'controller' => 'BreedControllerFactory',
                                'action' => 'allBreeds'
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => false,
        'display_exceptions'       => false,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/layout-iframe'           => __DIR__ . '/../view/layout/layout-iframe.phtml',
            'layout/layout-login'           => __DIR__ . '/../view/layout/layout-login.phtml',
            'layout/layout-admin'           => __DIR__ . '/../view/layout/layout-admin.phtml',
            //'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'view_helpers' => [
    'invokables' => [
        'PageHelper' => 'IodogsApplication\View\Helper\PageHelper',
        'ButtonHelper' => 'IodogsApplication\View\Helper\ButtonHelper',
    ],
    'factories' => [
    ],

    'module_layouts' => [
        /*'FileStorage' => 'layout/layout-admin',
        'IsleAdmin' => 'layout/layout-admin',*/
        'IodogsApplication' => 'layout/layout',

    ],
    ],
];
