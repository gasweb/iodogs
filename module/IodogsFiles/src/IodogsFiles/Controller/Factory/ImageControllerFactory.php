<?php
namespace IodogsFiles\Controller\Factory;

use IodogsFiles\Controller\ImageController,
    Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class ImageControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $ImageService = $realServiceLocator->get("ImageServiceFactory");
        $om = $realServiceLocator->get("Doctrine\ORM\EntityManager");
        return new ImageController ($ImageService, $realServiceLocator, $om);
    }
}