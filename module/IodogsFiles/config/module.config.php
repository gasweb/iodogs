<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'ImageUploadServiceFactory' => 'IodogsFiles\Service\Factory\ImageUploadServiceFactory',
            'ImageServiceFactory' => 'IodogsFiles\Service\Factory\ImageServiceFactory',
            'S3ServiceFactory' => 'IodogsFiles\Service\Factory\S3ServiceFactory',
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