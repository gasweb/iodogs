<?php
namespace IodogsApplication\Controller\Factory;

use IodogsApplication\Controller\InfoBlockAdminController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class InfoBlockAdminControllerFactory implements FactoryInterface
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
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $objectManager = $realServiceLocator->get('Doctrine\ORM\EntityManager');
//        $InfoBlockService = $realServiceLocator->get('ContentServiceFactory');


        return new InfoBlockAdminController($objectManager);
    }
}