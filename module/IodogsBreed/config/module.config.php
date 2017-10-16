<?php
namespace IodogsBreed;

use IodogsBreed\Controller\AdminBreedController,
    IodogsBreed\Controller\Factory\AdminBreedControllerFactory,
    IodogsBreed\Service\BreedService,
    IodogsBreed\Service\Factory\BreedServiceFactory;

return [
	'controllers' => [
		'factories' => [
			'BreedControllerFactory' => 'IodogsBreed\Controller\Factory\BreedControllerFactory',
            AdminBreedController::class => AdminBreedControllerFactory::class
        ],
    ],
    'service_manager' => [
			'factories' => [
                BreedService::class => BreedServiceFactory::class,
            ],
    ],
	'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];