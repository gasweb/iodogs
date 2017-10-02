<?php
namespace IodogsProduct\Controller\Factory;

 use IodogsProduct\Controller\ProductController;
 //use IodogsProduct\Service\Factory\ProductServiceFactory;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class ProductControllerFactory implements FactoryInterface
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
        $productService = $realServiceLocator->get('ProductServiceFactory');
        $reviewService = $realServiceLocator->get('ReviewServiceFactory');


         return new ProductController($productService, $reviewService);
     }
 }