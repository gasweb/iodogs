<?php
return array(
    'modules' => array(
//        'ZendDeveloperTools',
        'DoctrineModule',
        'DoctrineORMModule',
        'TwbBundle',
        'EdpModuleLayouts',
        'IodogsDoctrine',
        'IodogsProduct',
        'IodogsBreed',
        'IodogsCatalog',
        'IodogsApplication',
        'IodogsReview',
        'IodogsFiles',
        'IodogsAuth',
    ),
    'module_listener_options' => array(
        'module_paths' => array(
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{{,*.}global,{,*.}local}.php',
        ),
    ),
);
