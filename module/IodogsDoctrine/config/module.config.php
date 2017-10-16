<?php
namespace IodogsDoctrine;

return [
	 'doctrine' => [
        'driver' => [
            'iodogs_doctrine_entity' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => [__DIR__ . '/../src/IodogsDoctrine/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    'IodogsDoctrine\Entity' => 'iodogs_doctrine_entity',
                ]
            ]
        ]
     ],
];