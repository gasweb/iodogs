<?php
namespace IodogsApplication\Controller\Factory;

use IodogsApplication\Controller\SearchController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SearchControllerFactory implements FactoryInterface
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
        /*$ContentService = $realServiceLocator->get('ContentServiceFactory');*/


        return new SearchController($realServiceLocator);
    }
}