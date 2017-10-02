<?php
namespace IodogsCatalog\Controller\Factory;

use IodogsCatalog\Controller\SolutionController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SolutionControllerFactory implements FactoryInterface
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
        $ProductService = $realServiceLocator->get('ProductServiceFactory');
        $SolutionService = $realServiceLocator->get('SolutionServiceFactory');


        return new SolutionController($ProductService, $SolutionService);
    }
}