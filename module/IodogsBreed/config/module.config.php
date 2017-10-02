<?php
return array(
	'controllers' => array(
		'factories' => array(
			'BreedControllerFactory' => 'IodogsBreed\Controller\Factory\BreedControllerFactory',
			'AdminBreedControllerFactory' => 'IodogsBreed\Controller\Factory\AdminBreedControllerFactory',
			),
		),
    'service_manager' => array(
			'factories' => array(
				'BreedServiceFactory' => 'IodogsBreed\Service\Factory\BreedServiceFactory',
			),
        ),
	'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);