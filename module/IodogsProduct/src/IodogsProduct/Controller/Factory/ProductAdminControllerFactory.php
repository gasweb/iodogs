<?php
namespace IodogsProduct\Controller\Factory;

 use IodogsProduct\Controller\ProductAdminController;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class ProductAdminControllerFactory implements FactoryInterface
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
        $productService = $realServiceLocator->get('ProductServiceFactory');
        return new ProductAdminController($objectManager, $productService);
     }
 }