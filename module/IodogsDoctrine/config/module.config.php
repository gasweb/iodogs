<?php
return array(
	 'doctrine' => array(
        'driver' => array(
        'iodogs_doctrine_entity' => array(
        'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
        'paths' => array(__DIR__ . '/../src/IodogsDoctrine/Entity')
        ),
        'orm_default' => array(
        'drivers' => array(
        'IodogsDoctrine\Entity' => 'iodogs_doctrine_entity',
                )
            )
        )
    ),
);