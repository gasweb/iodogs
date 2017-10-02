<?php
namespace IodogsCatalog\Service\Factory;

use IodogsCatalog\Service\LineService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class LineServiceFactory implements FactoryInterface
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
        $infoBlockService = $serviceLocator->get('InfoBlockServiceFactory');
        return new LineService($objectManager, $infoBlockService);
    }
}