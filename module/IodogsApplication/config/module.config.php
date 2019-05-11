<?php
namespace IodogsApplication;

use IodogsApplication\Service\Cache\Application\ApplicationCacheService;
use IodogsApplication\Service\Cache\Factory\CacheServiceFactory;

use IodogsApplication\Service\Mail\MailService,
    IodogsApplication\Service\Mail\MailServiceFactory,
    IodogsApplication\Service\Mail\Transport\TransportService,
    IodogsApplication\Service\Mail\Transport\TransportServiceFactory;

//ZF3 use block
use Zend\Router\Http\Literal,
    Zend\Router\Http\Segment;

//Content use block
use IodogsApplication\Controller\AdminContentController,
    IodogsApplication\Controller\Factory\AdminContentControllerFactory,
    IodogsApplication\Controller\Factory\InfoBlockAdminControllerFactory,
    IodogsApplication\Controller\InfoBlockAdminController,
    IodogsApplication\Service\InfoBlockService,
    IodogsApplication\Service\Factory\InfoBlockServiceFactory,
    IodogsApplication\Controller\ContentController,
    IodogsApplication\Controller\Factory\ContentControllerFactory;

//Products use block
use IodogsProduct\Controller\ProductAdminController,
    IodogsProduct\Controller\AdminProductImageController,
    IodogsProduct\Controller\ProductController;

//Breed use block
use IodogsBreed\Controller\AdminBreedController,
    IodogsBreed\Controller\BreedController;

//Images use block
use IodogsFiles\Controller\ImageController;

//Categories use block
use IodogsCatalog\Controller\CategoryAdminController,
    IodogsCatalog\Controller\CatalogController;

//Line use block
use IodogsCatalog\Controller\LineAdminController,
    IodogsCatalog\Controller\LineController;

//Solution use block
use IodogsCatalog\Controller\SolutionAdminController,
    IodogsCatalog\Controller\SolutionController;

//Search use block
use IodogsApplication\Controller\SearchController,
    IodogsApplication\Controller\Factory\SearchControllerFactory;

//Old aplication
use IodogsApplication\Controller\OldApplicationController,
    IodogsApplication\Controller\Factory\OldApplicationControllerFactory;

return [
    'controllers' => [
        'factories' => [
            AdminContentController::class => AdminContentControllerFactory::class,
            ContentController::class => ContentControllerFactory::class,
            InfoBlockAdminController::class => InfoBlockAdminControllerFactory::class,
            SearchController::class => SearchControllerFactory::class,
            OldApplicationController::class => OldApplicationControllerFactory::class
        ]
    ],
    'service_manager' => [
   'factories' => [
       MailService::class => MailServiceFactory::class,
       TransportService::class => TransportServiceFactory::class,
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
                        'controller' => ContentController::class,
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
                                        'type' => Literal::class,
                                        'options' => [
                                            'route' => 'add',
                                            'defaults' => [
                                                'controller' => InfoBlockAdminController::class,
                                                'action' => 'add'
                                            ],
                                        ],
                                    ],
                                    'edit' => [
                                        'type' => Segment::class,
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
                                        'type' => Literal::class,
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
                                'type' => Literal::class,
                                'options' => [
                                    'route' => 'image',
                                ],
                                'may_terminate' => false,
                                'child_routes' => [
                                    'upload' => [
                                        'type' => Literal::class,
                                        'options' => [
                                            'route' => '/upload',
                                            'defaults' => [
                                                'controller' => ImageController::class,
                                                'action' => 'upload'
                                            ]
                                        ]
                                    ],
                                    'id' => [
                                        'type' => Segment::class,
                                        'options' => [
                                            'route' => '/[:id]',
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
                                                'type' => Segment::class,
                                                'options' => [
                                                    'route' => '/delete',
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
                                                'type' => Literal::class,
                                                'options' => [
                                                    'route' => '/deleted',
                                                    'defaults' => [
                                                        'controller' => ImageController::class,
                                                        'action' => 'deleteSuccess'
                                                    ]
                                                ]
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            'product' => [
                                'type' => Literal::class,
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
                                        'type' => Literal::class,
                                        'options' => [
                                            'route' => '/add',
                                            'defaults' => [
                                                'controller' => ProductAdminController::class,
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
                                                'controller' => ProductAdminController::class,
                                                'action'     => 'edit',
                                            ],
                                        ],
                                        'may_terminate' => true,
                                        'child_routes' => [
                                            'breed' => [
                                                'type' => Literal::class,
                                                'options' => [
                                                    'route' => '/breed',
                                                    'defaults' => [
                                                        'action' => 'breed'
                                                    ],
                                                ],
                                            ],
                                            'image' => [
                                                'type' => Segment::class,
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
                                                        'type' => Literal::class,
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
                                                'type' => Literal::class,
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
                                        'type' => Literal::class,
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
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/[:slug]',
                            'constraints' => [
                                'slug' => '[a-zA-Z-_0-9]+',
                            ],
                            'defaults' => [
                                'controller' => ContentController::class,
                                'action'     => 'slug',
                            ],
                        ],
                    ],
                    'learn' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/learn',
                            'defaults' => [
                                'controller' => ContentController::class,
                                'action' => 'learn'
                            ],
                        ],
                    ],
                    'search' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/search',
                            'defaults' => [
                                'controller' => SearchController::class,
                                'action' => 'index'
                            ],
                        ],
                    ],
                    'home' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/',
                            'defaults' => [
                                'controller' => ContentController::class,
                                'action'     => 'home',
                            ],
                        ],
                    ],
                    'wholesale' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/wholesale',
                            'defaults' => [
                                'controller' => ContentController::class,
                                'action' => 'wholesale'
                            ],
                        ],
                    ],
                    'buy' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/buy',
                            'defaults' => [
                                'controller' => ContentController::class,
                                'action' => 'contacts'
                            ],
                        ],
                    ],
                    'contacts' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/contacts',
                            'defaults' => [
                                'cache' => false,
                                'controller' => ContentController::class,
                                'action' => 'contacts'
                            ],
                        ],
                    ],
                    'video' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/video',
                            'defaults' => [
                                'controller' => ContentController::class,
                                'action' => 'video'
                            ],
                        ],
                    ],
                    'message-sent' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/message/sent',
                            'defaults' => [
                                'controller' => ContentController::class,
                                'action' => 'messageSent'
                            ],
                        ],
                    ],
                    'breed' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/breed/',
                            'defaults' => [
                                'controller' => BreedController::class,
                                'action'     => 'allBreeds',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'breed-slug' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '[:slug]',
                                    'constraints' => [
                                        'slug' => '[a-zA-Z0-9-]+',
                                    ],
                                    'defaults' => [
                                        'controller' => BreedController::class,
                                        'action' => 'breedSlug'
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'catalog' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/catalog/',
                            'defaults' => [
                                'controller' => CatalogController::class,
                                'action'     => 'category',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'category-slug' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '[:slug]',
                                    'constraints' => [
                                        'id' => '[0-9A-Za-z]+',
                                    ],
                                    'defaults' => [
                                        'controller' => CatalogController::class,
                                        'action'     => 'slug',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'solution' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/solution/',
                            'defaults' => [
                                'controller' => SolutionController::class,
                                'action'     => 'list',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'slug' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '[:slug]',
                                    'constraints' => [
                                        'id' => '[0-9A-Za-z]+',
                                    ],
                                    'defaults' => [
                                        'controller' => SolutionController::class,
                                        'action'     => 'slug',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'line' => [
                        'type'    => Literal::class,
                        'options' => [
                            'route'    => '/line/',
                            'defaults' => [
                                'controller' => LineController::class,
                                'action'     => 'line-list',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'slug' => [
                                'type' => Segment::class,
                                'options' => [
                                    'route' => '[:slug]',
                                    'constraints' => [
                                        'id' => '[0-9a-zA-Z-]+',
                                    ],
                                    'defaults' => [
                                        'controller' => LineController::class,
                                        'action'     => 'index',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'product' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/item/[:slug]',
                            'constraints' => [
                                'id' => '[0-9A-Za-z]+',
                            ],
                            'defaults' => [
                                'controller' => ProductController::class,
                                'action'     => 'index',
                            ],
                        ],
                    ],
                'old_product' => [
                    'type' => Segment::class,
                    'options' => [
                        'route' => '/product[:id]',
                        'constraints' => [
                            'id' => '[0-9]+'
                        ],
                        'defaults' => [
                            'controller' => OldApplicationController::class,
                            'action' => 'product'
                        ],
                    ],
                ],
                    'old_breed' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/breed[:id]',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                'controller' => OldApplicationController::class,
                                'action' => 'breed'
                            ],
                        ],
                    ],
                    'old_catalog' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/category[:id]',
                            'constraints' => [
                                'id' => '[0-9]+'
                            ],
                            'defaults' => [
                                'controller' => OldApplicationController::class,
                                'action' => 'category'
                            ],
                        ],
                    ],
                    'breed-default' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/breed',
                            'defaults' => [
                                'controller' => BreedController::class,
                                'action' => 'allBreeds'
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
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
