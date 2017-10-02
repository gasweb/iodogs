<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'AdminContentController' => 'IodogsApplication\Controller\AdminContentController',
            'OldApplicationController' => 'IodogsApplication\Controller\OldApplicationController',
        ),
        'factories' => array(
            'ContentControllerFactory' => 'IodogsApplication\Controller\Factory\ContentControllerFactory',
            'InfoBlockAdminControllerFactory' => 'IodogsApplication\Controller\Factory\InfoBlockAdminControllerFactory',
            'SearchControllerFactory' => 'IodogsApplication\Controller\Factory\SearchControllerFactory'
        )
    ),    
    'service_manager' => array(
   'factories' => array(
      'InfoBlockServiceFactory' => 'IodogsApplication\Service\Factory\InfoBlockServiceFactory',
      'NavigationFactory' => 'IodogsApplication\Navigation\MenuNavigationFactory',
      'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
      'ContentServiceFactory' => 'IodogsApplication\Service\Factory\ContentServiceFactory',
      'admin-nav' => 'IodogsApplication\Navigation\Factory\AdminNavigationFactory',
      'application-nav' => 'IodogsApplication\Navigation\Factory\ApplicationNavigationFactory',
      'product-nav' => 'IodogsApplication\Navigation\Factory\ProductNavigationFactory',
      'IodogsCacheService' => 'Zend\Cache\Service\StorageCacheFactory',
   ),
   'invokables' => array(                      
            ),
),
    'cache' => array(
        'adapter' => array(
            'name' => 'filesystem'
        ),
        'options' => array(
            'cache_dir' => 'data/cache/',
//            'ttl' => 50
            'ttl' => 86400
        ),
    ),
    'router' => array(
        'routes' => array(
            'region-subdomain' => array(
                'type' => 'hostname',
                'options' => array(
                    'defaults' => array(
                        'controller' => 'ContentControllerFactory',
                        'action' => 'region'
                    ),
                ),
            ),
            'app' => array(
                'child_routes' => array(
                    'content' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/[:slug]',
                            'constraints' => array(
                                'slug' => '[a-zA-Z-_0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'ContentControllerFactory',
                                'action'     => 'slug',
                            ),
                        ),
                    ),
                    'search' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/search',
                            'defaults' => array(
                                'controller' => 'SearchControllerFactory',
                                'action' => 'index'
                            ),
                        ),
                    ),
                    'home' => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/',
                            'defaults' => array(
                                'controller' => 'ContentControllerFactory',
                                'action'     => 'home',
                            ),
                        ),
                    ),
                    'wholesale' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/wholesale',
                            'defaults' => array(
                                'controller' => 'ContentControllerFactory',
                                'action' => 'wholesale'
                            ),
                        ),
                    ),
                    'buy' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/buy',
                            'defaults' => array(
                                'controller' => 'ContentControllerFactory',
                                'action' => 'buy'
                            ),
                        ),
                    ),
                    'contacts' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/contacts',
                            'defaults' => array(
                                'controller' => 'ContentControllerFactory',
                                'action' => 'contacts'
                            ),
                        ),
                    ),
                    'video' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/video',
                            'defaults' => array(
                                'controller' => 'ContentControllerFactory',
                                'action' => 'video'
                            ),
                        ),
                    ),
                    'message-sent' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/message/sent',
                            'defaults' => array(
                                'controller' => 'ContentControllerFactory',
                                'action' => 'messageSent'
                            ),
                        ),
                    ),
                    'admin-content-add' =>array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/admin/content/add',
                            'defaults' => array(
                                'controller' => 'AdminContentController',
                                'action' => 'add',
                            ),
                        ),
                    ),
                    'admin-content' =>array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/admin/content',
                            'defaults' => array(
                                'controller' => 'AdminContentController',
                                'action' => 'show',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'admin-content-id' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '[:id]',
                                    'constraints' => array(
                                        'id' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'AdminContentController',
                                        'action'     => 'edit',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'admin-content-delete' => array(
                                        'type' => 'literal',
                                        'options' => array(
                                            'route' => '/delete',
                                            'defaults' => array(
                                                'controller' => 'AdminContentController',
                                                'action'     => 'delete',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),

                    ),
                    'admin-info-block' =>array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/admin/info-block/',
                            'defaults' => array(
                                'controller' => 'InfoBlockAdminControllerFactory',
                                'action' => 'show',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'add' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => 'add',
                                    'defaults' => array(
                                        'controller' => 'InfoBlockAdminControllerFactory',
                                        'action' => 'add'
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '[:id]',
                                    'constraints' => array(
                                        'id' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'InfoBlockAdminControllerFactory',
                                        'action'     => 'edit',
                                    ),
                                ),
                            ),
                        ),

                    ),
                    'breed' => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/breed/',
                            'defaults' => array(
                                'controller' => 'BreedControllerFactory',
                                'action'     => 'allBreeds',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'breed-slug' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '[:slug]',
                                    'constraints' => array(
                                        'slug' => '[a-zA-Z0-9-]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'BreedControllerFactory',
                                        'action' => 'breedSlug'
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'iodogs-admin' => array(
                        'type'    => 'Literal',
                        'options' => array(
                            'route'    => '/admin/',
                            'defaults' => array(
                                'controller'    => 'AdminContentController',
                                'action'        => 'index',
                            ),
                        ),
                    ),
                    'admin-breed' =>array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/admin/breed',
                            'defaults' => array(
                                'controller' => 'AdminBreedControllerFactory',
                                'action' => 'show',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'add' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route' => '/add',
                                    'defaults' => array(
                                        'action' => 'add'
                                    ),
                                ),
                            ),
                            'admin-breed-id' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '[:breedId]',
                                    'constraints' => array(
                                        'breedId' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'AdminBreedControllerFactory',
                                        'action'     => 'edit',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'breed-product' => array(
                                        'type' => 'literal',
                                        'options' => array(
                                            'route' => '/products',
                                            'defaults' => array(
                                                'action' => 'breedProduct'
                                            ),
                                        ),
                                    ),
                                    'admin-breed-delete' => array(
                                        'type' => 'literal',
                                        'options' => array(
                                            'route' => '/delete',
                                            'defaults' => array(
                                                'controller' => 'AdminBreedControllerFactory',
                                                'action'     => 'delete',
                                            ),
                                        ),
                                    ),
                                    'admin-breed-image' => array(
                                        'type' => 'literal',
                                        'options' => array(
                                            'route' => '/image',
                                            'defaults' => array(
                                                'action' => 'imageUpload',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'catalog' => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/catalog/',
                            'defaults' => array(
                                'controller' => 'CatalogControllerFactory',
                                'action'     => 'category',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'category-slug' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '[:slug]',
                                    'constraints' => array(
                                        'id' => '[0-9A-Za-z]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'CatalogControllerFactory',
                                        'action'     => 'slug',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'solution' => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/solution/',
                            'defaults' => array(
                                'controller' => 'SolutionControllerFactory',
                                'action'     => 'list',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'slug' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '[:slug]',
                                    'constraints' => array(
                                        'id' => '[0-9A-Za-z]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'SolutionControllerFactory',
                                        'action'     => 'slug',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'line' => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/line/',
                            'defaults' => array(
                                'controller' => 'LineControllerFactory',
                                'action'     => 'lineList',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'slug' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '[:slug]',
                                    'constraints' => array(
                                        'id' => '[0-9a-zA-Z-]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'LineControllerFactory',
                                        'action'     => 'index',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'admin-line' =>array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/admin/line/',
                            'defaults' => array(
                                'controller' => 'LineAdminControllerFactory',
                                'action' => 'show',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'add' =>array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => 'add',
                                    'defaults' => array(
                                        'controller' => 'LineAdminControllerFactory',
                                        'action' => 'add',
                                    ),
                                ),
                            ),
                            'admin-line-id' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '[:lineId]',
                                    'constraints' => array(
                                        'lineId' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'LineAdminControllerFactory',
                                        'action'     => 'edit',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'admin-line-delete' => array(
                                        'type' => 'literal',
                                        'options' => array(
                                            'route' => '/delete',
                                            'defaults' => array(
                                                'controller' => 'LineAdminControllerFactory',
                                                'action'     => 'delete',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'admin-solution' =>array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/admin/solution/',
                            'defaults' => array(
                                'controller' => 'SolutionAdminControllerFactory',
                                'action' => 'show',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'add' =>array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => 'add',
                                    'defaults' => array(
                                        'controller' => 'SolutionAdminControllerFactory',
                                        'action' => 'add',
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '[:id]',
                                    'constraints' => array(
                                        'id' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'SolutionAdminControllerFactory',
                                        'action'     => 'edit',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'product' => array(
                                        'type' => 'Literal',
                                        'options' => array(
                                            'route' => '/product',
                                            'defaults' => array(
                                                'controller' => 'SolutionAdminControllerFactory',
                                                'action' => 'product',
                                            )
                                        ),
                                    ),
                                    'delete' => array(
                                        'type' => 'literal',
                                        'options' => array(
                                            'route' => '/delete',
                                            'defaults' => array(
                                                'controller' => 'SolutionAdminControllerFactory',
                                                'action'     => 'delete',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'admin-category' =>array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/admin/category/',
                            'defaults' => array(
                                'controller' => 'CategoryAdminControllerFactory',
                                'action' => 'show',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'add' =>array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => 'add',
                                    'defaults' => array(
                                        'controller' => 'CategoryAdminControllerFactory',
                                        'action' => 'add',
                                    ),
                                ),
                            ),
                            'admin-category-id' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '[:id]',
                                    'constraints' => array(
                                        'id' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'CategoryAdminControllerFactory',
                                        'action'     => 'edit',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'delete' => array(
                                        'type' => 'literal',
                                        'options' => array(
                                            'route' => '/delete',
                                            'defaults' => array(
                                                'controller' => 'CategoryAdminControllerFactory',
                                                'action'     => 'delete',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'product' => array(
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
                            'route' => '/admin/product/',
                            'defaults' => array(
                                'controller' => 'ProductAdminControllerFactory',
                                'action' => 'show',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'add' =>array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => 'add',
                                    'defaults' => array(
                                        'controller' => 'ProductAdminControllerFactory',
                                        'action' => 'add',
                                    ),
                                ),
                            ),
                            'id' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => '[:id]/',
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
                                            'route' => 'breed',
                                            'defaults' => array(
                                                'action' => 'breed'
                                            ),
                                        ),
                                    ),
                                    'image' =>array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => 'image',
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
                                            'add' => array(
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
                                    ),
                                    'delete' => array(
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
                    'admin-image' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/admin/image/[:id]/',
                            'constraints' => array(
                                'id' => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'ImageControllerFactory',
                                'action' => 'edit'
                            )
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'delete' => array(
                                'type' => 'segment',
                                'options' => array(
                                    'route' => 'delete',
                                    'constraints' => array(
                                        'id' => '[0-9]+',
                                    ),
                                    'defaults' => array(
                                        'controller' => 'ImageControllerFactory',
                                        'action' => 'delete'
                                    )
                                )
                            ),
                            'delete-success' => array(
                                'type' => 'literal',
                                'options' => array(
                                    'route' => 'deleted',
                                    'defaults' => array(
                                        'controller' => 'ImageControllerFactory',
                                        'action' => 'deleteSuccess'
                                    )
                                )
                            ),
                        ),
                    ),
                'old_product' => array(
                    'type' => 'segment',
                    'options' => array(
                        'route' => '/product[:id]',
                        'constraints' => array(
                            'id' => '[0-9]+'
                        ),
                        'defaults' => array(
                            'controller' => 'OldApplicationController',
                            'action' => 'product'
                            ),
                        ),
                    ),
                    'old_breed' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/breed[:id]',
                            'constraints' => array(
                                'id' => '[0-9]+'
                            ),
                            'defaults' => array(
                                'controller' => 'OldApplicationController',
                                'action' => 'breed'
                            ),
                        ),
                    ),
                    'old_catalog' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/category[:id]',
                            'constraints' => array(
                                'id' => '[0-9]+'
                            ),
                            'defaults' => array(
                                'controller' => 'OldApplicationController',
                                'action' => 'category'
                            ),
                        ),
                    ),
                    'breed-default' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/breed',
                            'defaults' => array(
                                'controller' => 'BreedControllerFactory',
                                'action' => 'allBreeds'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'navigation' => array(
        'application-nav' => array(
            'about' => array(
                'label' => 'О косметике',
                'route' => 'app/home',
                'pages' => array(
                    array(
                    'route' => 'app/content',
                    'label' => 'История бренда',
                        'params' => array('slug' => 'brand')
                    ),
                    array(
                    'route' => 'app/content',
                    'label' => 'Ингредиенты',
                        'params' => array('slug' => 'ingredients')
                    ),
                    array(
                        'route' => 'app/content',
                        'label' => 'Вопросы и ответы',
                        'params' => array('slug' => 'faq')
                    ),
                    array(
                        'route' => 'app/video',
                        'label' => 'Видео',
                    ),

                ),
            ),
            'catalog' => array(
                'label' => 'Продукция',
                'route' => 'app/catalog',
                'pages' => array(
                    array(
                        'label' => 'Шампуни',
                        'route' => 'app/catalog/category-slug',
                        'params' => array(
                            'slug' => 'shampoo'
                        ),
                    ),
                  array(
                        'label' => 'Кондиционеры',
                        'route' => 'app/catalog/category-slug',
                        'params' => array(
                            'slug' => 'conditioners'
                        ),
                    ),
                  array(
                        'label' => 'Спреи для грумминга',
                        'route' => 'app/catalog/category-slug',
                        'params' => array(
                            'slug' => 'spray'
                        ),
                    ),
                  array(
                        'label' => 'Добавки для шерсти',
                        'route' => 'app/catalog/category-slug',
                        'params' => array(
                            'slug' => 'supplements'
                        ),
                    ),
                  array(
                        'label' => 'Средства для укладки',
                        'route' => 'app/catalog/category-slug',
                        'params' => array(
                            'slug' => 'styling'
                        ),
                    ),
                  array(
                        'label' => 'Дезодоранты',
                        'route' => 'app/catalog/category-slug',
                        'params' => array(
                            'slug' => 'replascent'
                        ),
                    ),
                ),
            ),
            'lines' => array(
                'label' => 'Серии',
                'route' => 'app/line',
                'pages' => array(
                    array(
                        'label' => 'Coature',
                        'route' => 'app/line/slug',
                        'params' => array(
                            'slug' => 'coature'
                        ),
                    ),
                array(
                        'label' => 'Vanity',
                        'route' => 'app/line/slug',
                        'params' => array(
                            'slug' => 'vanity'
                        ),
                    ),
                array(
                        'label' => 'Salon',
                        'route' => 'app/line/slug',
                        'params' => array(
                            'slug' => 'salon'
                        ),
                    ),
                array(
                        'label' => 'Everyday',
                        'route' => 'app/line/slug',
                        'params' => array(
                            'slug' => 'everyday'
                        ),
                    ),
                array(
                        'label' => 'Naturaluxury Everyday',
                        'route' => 'app/line/slug',
                        'params' => array(
                            'slug' => 'naturaluxury-everyday'
                        ),
                    ),
                ),
            ),
            'solutions' => array(
                'label' => 'Решения',
                'route' => 'app/content',
                'params' => array(
                    'slug' => 'solutions'
                ),
                'pages' => array(
                    array(
                    'label' => 'Для породы',
                    'route' => 'app/breed',
                    ),
                    array(
                    'label' => 'Выпадение шерсти',
                    'route' => 'app/solution/slug',
                     'params' => array('slug' => 'shedding')
                    ),
                    array(
                    'label' => 'Зудящая, шелушащаяся кожа',
                    'route' => 'app/solution/slug',
                     'params' => array('slug' => 'itchy-flaky-skin')
                    ),
                    array(
                    'label' => 'Нежелательный запах',
                    'route' => 'app/solution/slug',
                     'params' => array('slug' => 'undesirable-odor')
                    ),
                    array(
                    'label' => 'Аллергии',
                    'route' => 'app/solution/slug',
                     'params' => array('slug' => 'allergies')
                    ),
                    array(
                    'label' => 'Тонкая, безжизненная шерсть',
                    'route' => 'app/solution/slug',
                     'params' => array('slug' => 'thin-lifeless-hair')
                    ),
                    array(
                    'label' => 'Тусклая шерсть',
                    'route' => 'app/solution/slug',
                     'params' => array('slug' => 'dull-coat')
                    ),
                    array(
                    'label' => 'Наэлектризованная, непослушная шерсть',
                    'route' => 'app/solution/slug',
                     'params' => array('slug' => 'static-flyaways')
                    ),






                ),
            ),
            'learn' => array(
                'label' => 'Обучение',
                'route' => 'app/content',
                'params' => array(
                    'slug' => 'learn'
                ),
                'pages' => array(
                    array(
                        'route' => 'app/content',
                        'label' => 'Основы купания',
                        'params' => array('slug' => 'bathe-basic')
                    ),
                    array(
                        'route' => 'app/content',
                        'label' => 'Основы сушки',
                        'params' => array('slug' => 'dry-basic')
                    ),
                    array(
                        'route' => 'app/content',
                        'label' => 'Разрушаем мифы',
                        'params' => array('slug' => 'myths')
                    ),
                    array(
                        'route' => 'app/content',
                        'label' => 'Правила ухода за собакой',
                        'params' => array('slug' => 'do-dont')
                    ),
                    array(
                        'route' => 'app/content',
                        'label' => 'Уход за щенками',
                        'params' => array('slug' => 'puppy')
                    ),
                    array(
                        'route' => 'app/content',
                        'label' => 'Типы шерсти',
                        'params' => array('slug' => 'coat-types')
                    ),

                ),
            ),
        ),
            'admin-nav' => array(
                'category' => array(
                    'label' => 'Категории',
                    'route' => 'app/admin-category',
                    'pages' => array(
                        array(
                            'route' => 'app/admin-category',
                            'label' => 'Список категорий'
                            ),
                        array(
                            'route' => 'app/admin-category/add',
                            'label' => 'Добавить категорию'
                            ),
                        ),
                    ),                
                'products' => array(
                    'label' => 'Продукты',
                    'route' => 'app/admin-product',
                        'pages' => array(                               
                                array(
                                    'route' => 'app/admin-product',
                                    'label' => 'Список продуктов',
                                    ),
                                array(
                                    'route' => 'app/admin-product/add',
                                    'label' => 'Добавить продукт',
                                    ),
                            ),                  
                ),                                                             
                 'content' => array(
                    'label' => 'Материалы',
                    'route' => 'app/admin-content',
                    'pages' => array(
                        array(
                            'route' => 'app/admin-content',
                            'label' => 'Список материалов'
                            ),
                        array(
                            'route' => 'app/admin-content-add',
                            'label' => 'Добавить материал'
                            ),
                        ),
                    ),
                'info_block' => array(
                    'label' => 'Инфоблоки',
                    'route' => 'app/admin-info-block',
                    'pages' => array(
                        array(
                            'route' => 'app/admin-info-block',
                            'label' => 'Список инфоблоков'
                            ),
                        array(
                            'route' => 'app/admin-info-block/add',
                            'label' => 'Добавить инфоблок'
                            ),
                        ),
                    ),
                 'lines' => array(
                    'label' => 'Серии',
                    'route' => 'app/admin-line',
                    'pages' => array(
                        array(
                            'route' => 'app/admin-line',
                            'label' => 'Список серий'
                            ),
                        array(
                            'route' => 'app/admin-line/add',
                            'label' => 'Добавить серию'
                            ),
                        ),
                    ),
                'breeds' => array(
                    'label' => 'Породы',
                    'route' => 'app/admin-breed',
                    'pages' => array(
                        array(
                            'route' => 'app/admin-breed',
                            'label' => 'Список пород'
                            ),
                        array(
                            'route' => 'app/admin-breed/add',
                            'label' => 'Добавить породу'
                            ),
                        ),
                    ),
                'solution' => array(
                    'label' => 'Решения',
                    'route' => 'app/admin-solution',
                    'pages' => array(
                        array(
                            'route' => 'app/admin-solution',
                            'label' => 'Список'
                            ),
                        array(
                            'route' => 'app/admin-solution/add',
                            'label' => 'Добавить решение'
                            ),
                        ),
                    ),

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
                ),
        ),
    'view_manager' => array(
        'display_not_found_reason' => false,
        'display_exceptions'       => false,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/layout-iframe'           => __DIR__ . '/../view/layout/layout-iframe.phtml',
            'layout/layout-login'           => __DIR__ . '/../view/layout/layout-login.phtml',
            'layout/layout-admin'           => __DIR__ . '/../view/layout/layout-admin.phtml',
            //'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
    'invokables' => array(               
        'PageHelper' => 'IodogsApplication\View\Helper\PageHelper',
        'ButtonHelper' => 'IodogsApplication\View\Helper\ButtonHelper',         
    ),
    'factories' => array(       
    ),
    'translator' => array(
        'locale' => 'ru_RU',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),

    'module_layouts' => array(
        /*'FileStorage' => 'layout/layout-admin',
        'IsleAdmin' => 'layout/layout-admin',*/
        'IodogsApplication' => 'layout/layout',
        
    ),
    ),
);
