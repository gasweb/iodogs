<?php

use IodogsFiles\Service\S3Service,
    IodogsFiles\Service\Factory\S3ServiceFactory,
    IodogsFiles\Service\ImageService,
    IodogsFiles\Service\Factory\ImageServiceFactory;

return [
    'service_manager' => [
        'factories' => [
            'ImageUploadServiceFactory' => 'IodogsFiles\Service\Factory\ImageUploadServiceFactory',
            S3Service::class => S3ServiceFactory::class,
            ImageService::class => ImageServiceFactory::class
        ],
    ],
    'controllers' => [
        'factories' => [
            'ImageControllerFactory' => 'IodogsFiles\Controller\Factory\ImageControllerFactory',

        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];