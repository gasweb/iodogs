<?php
namespace IodogsBreed;

use IodogsBreed\Controller\AdminBreedController,
    IodogsBreed\Controller\Factory\AdminBreedControllerFactory;

return [
	'controllers' => [
		'factories' => [
			'BreedControllerFactory' => 'IodogsBreed\Controller\Factory\BreedControllerFactory',
            AdminBreedController::class => AdminBreedControllerFactory::class
        ],
    ],
    'service_manager' => [
			'factories' => [
				'BreedServiceFactory' => 'IodogsBreed\Service\Factory\BreedServiceFactory',
            ],
    ],
	'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];