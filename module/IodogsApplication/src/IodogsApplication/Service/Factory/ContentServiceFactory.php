<?php
namespace IodogsApplication\Service\Factory;

use IodogsApplication\Service\ContentService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContentServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $objectManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        return new ContentService($objectManager);
    }
}