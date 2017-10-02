<?php
namespace IodogsBreed\Controller\Factory;

use \Zend\ServiceManager\FactoryInterface,
    \Zend\ServiceManager\ServiceLocatorInterface,
    IodogsBreed\Controller\AdminBreedController;

class AdminBreedControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sl)
    {
        $realServiceLocator = $sl->getServiceLocator();
        $breedService = $realServiceLocator->get("BreedServiceFactory");
        $imageUploadService = $realServiceLocator->get("ImageUploadServiceFactory");
        $om = $realServiceLocator->get('Doctrine\ORM\EntityManager');

        return new AdminBreedController($om, $breedService, $imageUploadService);
    }
}