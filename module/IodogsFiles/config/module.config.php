<?php

use IodogsFiles\Service\S3Service,
    IodogsFiles\Service\Factory\S3ServiceFactory;

return array(
    'service_manager' => array(
        'factories' => array(
            'ImageUploadServiceFactory' => 'IodogsFiles\Service\Factory\ImageUploadServiceFactory',
            'ImageServiceFactory' => 'IodogsFiles\Service\Factory\ImageServiceFactory',
            S3Service::class => S3ServiceFactory::class,
        ),
    ),
    'controllers' => array(
        'factories' => array(
            'ImageControllerFactory' => 'IodogsFiles\Controller\Factory\ImageControllerFactory',

        )
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);