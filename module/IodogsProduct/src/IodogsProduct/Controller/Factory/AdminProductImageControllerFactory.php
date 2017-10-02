<?php
namespace IodogsProduct\Controller\Factory;

use IodogsProduct\Controller\AdminProductImageController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AdminProductImageControllerFactory implements FactoryInterface
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
        $imageUploadService = $realServiceLocator->get('ImageUploadServiceFactory');
        $productService = $realServiceLocator->get('ProductServiceFactory');

        return new AdminProductImageController($objectManager, $imageUploadService, $productService);
    }
}
