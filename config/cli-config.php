<?php
/**
 * ZF3 USE BLOCK
 */
use Zend\Mvc\Application,
    Zend\Stdlib\ArrayUtils;

/**
 * Doctrine USE BLOCK
 */
use Doctrine\ORM\Tools\Console\ConsoleRunner,
    Doctrine\ORM\EntityManager;

require 'vendor/autoload.php';

// Retrieve configuration
$application_config = require 'application.config.php';
if (file_exists(__DIR__.'/development.config.php')) {
    $application_config = ArrayUtils::merge($application_config, require 'development.config.php');
}

/** @var \Interop\Container\ContainerInterface $container */
$container = Application::init($application_config)->getServiceManager();

/** @var \Doctrine\ORM\EntityManager $entity_manager */
$entity_manager = $container->get(EntityManager::class);
return ConsoleRunner::createHelperSet($entity_manager);