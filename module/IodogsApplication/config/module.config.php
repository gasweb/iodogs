<?php
namespace IodogsApplication;

use IodogsApplication\Service\Cache\Application\ApplicationCacheService;
use IodogsApplication\Service\Cache\Factory\CacheServiceFactory;

//ZF3 use block
use Zend\Router\Http\Literal,
    Zend\Router\Http\Segment;

//Content use block
use IodogsApplication\Controller\AdminContentController,
    IodogsApplication\Controller\Factory\AdminContentControllerFactory;

return [
    'controllers' => [
        'invokables' => [
            'OldApplicationController' => 'IodogsApplication\Controller\OldApplicationController',
        ],
        'factories' => [
            AdminContentController::class => AdminContentControllerFactory::class,
            'ContentControllerFactory' => 'IodogsApplication\Controller\Factory\ContentControllerFactory',
            'InfoBlockAdminControllerFactory' => 'IodogsApplication\Controller\Factory\InfoBlockAdminControllerFactory',
            'SearchControllerFactory' => 'IodogsApplication\Controller\Factory\SearchControllerFactory'
        ]
    ],
    'service_manager' => [
   'factories' => [
      'InfoBlockServiceFactory' => 'IodogsApplication\Service\Factory\InfoBlockServiceFactory',
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
                            'route' => '/admin',
                            'defaults' => [
                                'cache' => false,
                            ],
                        ],
                        'may_terminate' => false,
                        'child_routes' => [
                            'content' => [
                                'type' => Literal::class,
                                'options' => [
                                    'route' => '/content',
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
                    'admin-info-block' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/admin/info-block/',
                            'defaults' => [
                                'controller' => 'InfoBlockAdminControllerFactory',
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
                                        'controller' => 'InfoBlockAdminControllerFactory',
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
                                        'controller' => 'InfoBlockAdminControllerFactory',
                                        'action'     => 'edit',
                                    ],
                                ],
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
                    'admin-breed' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/admin/breed',
                            'defaults' => [
                                'controller' => 'AdminBreedControllerFactory',
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
                            'admin-breed-id' => [
                                'type' => 'segment',
                                'options' => [
                                    'route' => '[:breedId]',
                                    'constraints' => [
                                        'breedId' => '[0-9]+',
                                    ],
                                    'defaults' => [
                                        'controller' => 'AdminBreedControllerFactory',
                                        'action'     => 'edit',
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'breed-product' => [
                                        'type' => 'literal',
                                        'options' => [
                                            'route' => '/products',
                                            'defaults' => [
                                                'action' => 'breedProduct'
                                            ],
                                        ],
                                    ],
                                    'admin-breed-delete' => [
                                        'type' => 'literal',
                                        'options' => [
                                            'route' => '/delete',
                                            'defaults' => [
                                                'controller' => 'AdminBreedControllerFactory',
                                                'action'     => 'delete',
                                            ],
                                        ],
                                    ],
                                    'admin-breed-image' => [
                                        'type' => 'literal',
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
                    'admin-line' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/admin/line/',
                            'defaults' => [
                                'controller' => 'LineAdminControllerFactory',
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
                                        'controller' => 'LineAdminControllerFactory',
                                        'action' => 'add',
                                    ],
                                ],
                            ],
                            'admin-line-id' => [
                                'type' => 'segment',
                                'options' => [
                                    'route' => '[:lineId]',
                                    'constraints' => [
                                        'lineId' => '[0-9]+',
                                    ],
                                    'defaults' => [
                                        'controller' => 'LineAdminControllerFactory',
                                        'action'     => 'edit',
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'admin-line-delete' => [
                                        'type' => 'literal',
                                        'options' => [
                                            'route' => '/delete',
                                            'defaults' => [
                                                'controller' => 'LineAdminControllerFactory',
                                                'action'     => 'delete',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'admin-solution' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/admin/solution/',
                            'defaults' => [
                                'controller' => 'SolutionAdminControllerFactory',
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
                                        'controller' => 'SolutionAdminControllerFactory',
                                        'action' => 'add',
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
                                        'controller' => 'SolutionAdminControllerFactory',
                                        'action'     => 'edit',
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'product' => [
                                        'type' => 'Literal',
                                        'options' => [
                                            'route' => '/product',
                                            'defaults' => [
                                                'controller' => 'SolutionAdminControllerFactory',
                                                'action' => 'product',
                                            ]
                                        ],
                                    ],
                                    'delete' => [
                                        'type' => 'literal',
                                        'options' => [
                                            'route' => '/delete',
                                            'defaults' => [
                                                'controller' => 'SolutionAdminControllerFactory',
                                                'action'     => 'delete',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'admin-category' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/admin/category/',
                            'defaults' => [
                                'controller' => 'CategoryAdminControllerFactory',
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
                                        'controller' => 'CategoryAdminControllerFactory',
                                        'action' => 'add',
                                    ],
                                ],
                            ],
                            'admin-category-id' => [
                                'type' => 'segment',
                                'options' => [
                                    'route' => '[:id]',
                                    'constraints' => [
                                        'id' => '[0-9]+',
                                    ],
                                    'defaults' => [
                                        'controller' => 'CategoryAdminControllerFactory',
                                        'action'     => 'edit',
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'delete' => [
                                        'type' => 'literal',
                                        'options' => [
                                            'route' => '/delete',
                                            'defaults' => [
                                                'controller' => 'CategoryAdminControllerFactory',
                                                'action'     => 'delete',
                                            ],
                                        ],
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
                    'admin-product' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/admin/product/',
                            'defaults' => [
                                'controller' => 'ProductAdminControllerFactory',
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
                                        'controller' => 'ProductAdminControllerFactory',
                                        'action' => 'add',
                                    ],
                                ],
                            ],
                            'id' => [
                                'type' => 'segment',
                                'options' => [
                                    'route' => '[:id]/',
                                    'constraints' => [
                                        'id' => '[0-9]+',
                                    ],
                                    'defaults' => [
                                        'controller' => 'ProductAdminControllerFactory',
                                        'action'     => 'edit',
                                    ],
                                ],
                                'may_terminate' => true,
                                'child_routes' => [
                                    'breed' => [
                                        'type' => 'literal',
                                        'options' => [
                                            'route' => 'breed',
                                            'defaults' => [
                                                'action' => 'breed'
                                            ],
                                        ],
                                    ],
                                    'image' => [
                                        'type' => 'Segment',
                                        'options' => [
                                            'route' => 'image',
                                            'constraints' => [
                                                'id' => '[0-9]+',
                                            ],
                                            'defaults' => [
                                                'controller' => 'AdminProductImageControllerFactory',
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
                                                        'controller' => 'AdminProductImageControllerFactory',
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
                                                'controller' => 'ProductAdminControllerFactory',
                                                'action'     => 'delete',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    'admin-image' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/admin/image/[:id]/',
                            'constraints' => [
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'ImageControllerFactory',
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
                                        'controller' => 'ImageControllerFactory',
                                        'action' => 'delete'
                                    ]
                                ]
                            ],
                            'delete-success' => [
                                'type' => 'literal',
                                'options' => [
                                    'route' => 'deleted',
                                    'defaults' => [
                                        'controller' => 'ImageControllerFactory',
                                        'action' => 'deleteSuccess'
                                    ]
                                ]
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
    'navigation' => [
        'application-nav' => [
            'about' => [
                'label' => 'О косметике',
                'route' => 'app/home',
                'pages' => [
                    [
                    'route' => 'app/content',
                    'label' => 'История бренда',
                        'params' => ['slug' => 'brand']
                    ],
                    [
                    'route' => 'app/content',
                    'label' => 'Ингредиенты',
                        'params' => ['slug' => 'ingredients']
                    ],
                    [
                        'route' => 'app/content',
                        'label' => 'Вопросы и ответы',
                        'params' => ['slug' => 'faq']
                    ],
                    [
                        'route' => 'app/video',
                        'label' => 'Видео',
                    ],

                ],
            ],
            'catalog' => [
                'label' => 'Продукция',
                'route' => 'app/catalog',
                'pages' => [
                    [
                        'label' => 'Шампуни',
                        'route' => 'app/catalog/category-slug',
                        'params' => [
                            'slug' => 'shampoo'
                        ],
                    ],
                  [
                        'label' => 'Кондиционеры',
                        'route' => 'app/catalog/category-slug',
                        'params' => [
                            'slug' => 'conditioners'
                        ],
                  ],
                  [
                        'label' => 'Спреи для грумминга',
                        'route' => 'app/catalog/category-slug',
                        'params' => [
                            'slug' => 'spray'
                        ],
                  ],
                  [
                        'label' => 'Добавки для шерсти',
                        'route' => 'app/catalog/category-slug',
                        'params' => [
                            'slug' => 'supplements'
                        ],
                  ],
                  [
                        'label' => 'Средства для укладки',
                        'route' => 'app/catalog/category-slug',
                        'params' => [
                            'slug' => 'styling'
                        ],
                  ],
                  [
                        'label' => 'Дезодоранты',
                        'route' => 'app/catalog/category-slug',
                        'params' => [
                            'slug' => 'replascent'
                        ],
                  ],
                ],
            ],
            'lines' => [
                'label' => 'Серии',
                'route' => 'app/line',
                'pages' => [
                    [
                        'label' => 'Coature',
                        'route' => 'app/line/slug',
                        'params' => [
                            'slug' => 'coature'
                        ],
                    ],
                [
                        'label' => 'Vanity',
                        'route' => 'app/line/slug',
                        'params' => [
                            'slug' => 'vanity'
                        ],
                ],
                [
                        'label' => 'Salon',
                        'route' => 'app/line/slug',
                        'params' => [
                            'slug' => 'salon'
                        ],
                ],
                [
                        'label' => 'Everyday',
                        'route' => 'app/line/slug',
                        'params' => [
                            'slug' => 'everyday'
                        ],
                ],
                [
                        'label' => 'Naturaluxury Everyday',
                        'route' => 'app/line/slug',
                        'params' => [
                            'slug' => 'naturaluxury-everyday'
                        ],
                ],
                ],
            ],
            'solutions' => [
                'label' => 'Решения',
                'route' => 'app/content',
                'params' => [
                    'slug' => 'solutions'
                ],
                'pages' => [
                    [
                    'label' => 'Для породы',
                    'route' => 'app/breed',
                    ],
                    [
                    'label' => 'Выпадение шерсти',
                    'route' => 'app/solution/slug',
                     'params' => ['slug' => 'shedding']
                    ],
                    [
                    'label' => 'Зудящая, шелушащаяся кожа',
                    'route' => 'app/solution/slug',
                     'params' => ['slug' => 'itchy-flaky-skin']
                    ],
                    [
                    'label' => 'Нежелательный запах',
                    'route' => 'app/solution/slug',
                     'params' => ['slug' => 'undesirable-odor']
                    ],
                    [
                    'label' => 'Аллергии',
                    'route' => 'app/solution/slug',
                     'params' => ['slug' => 'allergies']
                    ],
                    [
                    'label' => 'Тонкая, безжизненная шерсть',
                    'route' => 'app/solution/slug',
                     'params' => ['slug' => 'thin-lifeless-hair']
                    ],
                    [
                    'label' => 'Тусклая шерсть',
                    'route' => 'app/solution/slug',
                     'params' => ['slug' => 'dull-coat']
                    ],
                    [
                    'label' => 'Наэлектризованная, непослушная шерсть',
                    'route' => 'app/solution/slug',
                     'params' => ['slug' => 'static-flyaways']
                    ],


                ],
            ],
            'learn' => [
                'label' => 'Обучение',
                'route' => 'app/content',
                'params' => [
                    'slug' => 'learn'
                ],
                'pages' => [
                    [
                        'route' => 'app/content',
                        'label' => 'Основы купания',
                        'params' => ['slug' => 'bathe-basic']
                    ],
                    [
                        'route' => 'app/content',
                        'label' => 'Основы сушки',
                        'params' => ['slug' => 'dry-basic']
                    ],
                    [
                        'route' => 'app/content',
                        'label' => 'Разрушаем мифы',
                        'params' => ['slug' => 'myths']
                    ],
                    [
                        'route' => 'app/content',
                        'label' => 'Правила ухода за собакой',
                        'params' => ['slug' => 'do-dont']
                    ],
                    [
                        'route' => 'app/content',
                        'label' => 'Уход за щенками',
                        'params' => ['slug' => 'puppy']
                    ],
                    [
                        'route' => 'app/content',
                        'label' => 'Типы шерсти',
                        'params' => ['slug' => 'coat-types']
                    ],

                ],
            ],
        ],
            'admin-nav' => [
                'category' => [
                    'label' => 'Категории',
                    'route' => 'app/admin-category',
                    'pages' => [
                        [
                            'route' => 'app/admin-category',
                            'label' => 'Список категорий'
                        ],
                        [
                            'route' => 'app/admin-category/add',
                            'label' => 'Добавить категорию'
                        ],
                    ],
                ],
                'products' => [
                    'label' => 'Продукты',
                    'route' => 'app/admin-product',
                        'pages' => [
                                [
                                    'route' => 'app/admin-product',
                                    'label' => 'Список продуктов',
                                ],
                                [
                                    'route' => 'app/admin-product/add',
                                    'label' => 'Добавить продукт',
                                ],
                        ],
                ],
                 'content' => [
                    'label' => 'Материалы',
                    'route' => 'app/backoffice/content',
                    'pages' => [
                        [
                            'route' => 'app/backoffice/content',
                            'label' => 'Список материалов'
                        ],
                        [
                            'route' => 'app/backoffice/content/add',
                            'label' => 'Добавить материал'
                        ],
                    ],
                 ],
                'info_block' => [
                    'label' => 'Инфоблоки',
                    'route' => 'app/admin-info-block',
                    'pages' => [
                        [
                            'route' => 'app/admin-info-block',
                            'label' => 'Список инфоблоков'
                        ],
                        [
                            'route' => 'app/admin-info-block/add',
                            'label' => 'Добавить инфоблок'
                        ],
                    ],
                ],
                 'lines' => [
                    'label' => 'Серии',
                    'route' => 'app/admin-line',
                    'pages' => [
                        [
                            'route' => 'app/admin-line',
                            'label' => 'Список серий'
                        ],
                        [
                            'route' => 'app/admin-line/add',
                            'label' => 'Добавить серию'
                        ],
                    ],
                 ],
                'breeds' => [
                    'label' => 'Породы',
                    'route' => 'app/admin-breed',
                    'pages' => [
                        [
                            'route' => 'app/admin-breed',
                            'label' => 'Список пород'
                        ],
                        [
                            'route' => 'app/admin-breed/add',
                            'label' => 'Добавить породу'
                        ],
                    ],
                ],
                'solution' => [
                    'label' => 'Решения',
                    'route' => 'app/admin-solution',
                    'pages' => [
                        [
                            'route' => 'app/admin-solution',
                            'label' => 'Список'
                        ],
                        [
                            'route' => 'app/admin-solution/add',
                            'label' => 'Добавить решение'
                        ],
                    ],
                ],

                /*'distributors' => array(
                    'label' => 'Дистрибьюторы',
                    'route' => 'admin-distributor',
                    'pages' => array(
                        array(
                            'route' => 'admin-distributor',
                            'label' => 'Список дистрибьюторов'
                            ),
                        array(
                            'route' => 'admin-distributor-add',
                            'label' => 'Добавить дистрибьютора'
                            ),
                        ),
                    ),
                'review' => array(
                    'label' => 'Отзывы',
                    'route' => 'admin-review',
                    'pages' => array(
                        array(
                            'route' => 'admin-review',
                            'label' => 'Список отзывов'
                            ),
                        array(
                            'route' => 'admin-review-add',
                            'label' => 'Добавить '
                            ),
                        ),
                    ),*/
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
