<?php
namespace IodogsBreed\Controller\Factory;

use \Zend\ServiceManager\FactoryInterface,
    \Zend\ServiceManager\ServiceLocatorInterface,
    IodogsBreed\Controller\BreedController;

class BreedControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sl)
    {
        $realServiceLocator = $sl->getServiceLocator();
        $productService = $realServiceLocator->get("ProductServiceFactory");
        $breedService = $realServiceLocator->get("BreedServiceFactory");
        $reviewService = $realServiceLocator->get("ReviewServiceFactory");

        return new BreedController($productService, $breedService, $reviewService);
    }
}