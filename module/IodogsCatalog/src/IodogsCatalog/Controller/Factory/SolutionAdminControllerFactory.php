<?php
namespace IodogsCatalog\Controller\Factory;

use IodogsCatalog\Controller\SolutionAdminController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SolutionAdminControllerFactory implements FactoryInterface
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
        $solutionService = $realServiceLocator->get('SolutionServiceFactory');
        return new SolutionAdminController($objectManager, $solutionService);
    }
}