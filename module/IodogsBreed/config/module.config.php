<?php
namespace IodogsBreed;

use IodogsBreed\Controller\AdminBreedController,
    IodogsBreed\Controller\Factory\AdminBreedControllerFactory,
    IodogsBreed\Service\BreedService,
    IodogsBreed\Service\Factory\BreedServiceFactory,
    IodogsBreed\Controller\BreedController,
    IodogsBreed\Controller\Factory\BreedControllerFactory;

return [
	'controllers' => [
		'factories' => [
            BreedController::class => BreedControllerFactory::class,
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