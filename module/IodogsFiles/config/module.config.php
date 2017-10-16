<?php

use IodogsFiles\Service\S3Service,
    IodogsFiles\Service\Factory\S3ServiceFactory,
    IodogsFiles\Service\ImageService,
    IodogsFiles\Service\Factory\ImageServiceFactory,
    IodogsFiles\Controller\Factory\ImageControllerFactory,
    IodogsFiles\Controller\ImageController,
    IodogsFiles\Service\Factory\ImageUploadServiceFactory,
    IodogsFiles\Service\ImageUploadService;

return [
    'service_manager' => [
        'factories' => [
            ImageUploadService::class => ImageUploadServiceFactory::class,
            S3Service::class => S3ServiceFactory::class,
            ImageService::class => ImageServiceFactory::class
        ],
    ],
    'controllers' => [
        'factories' => [
            ImageController::class => ImageControllerFactory::class,

        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];