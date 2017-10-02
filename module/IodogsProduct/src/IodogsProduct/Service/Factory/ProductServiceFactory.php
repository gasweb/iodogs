<?php
namespace IodogsProduct\Service\Factory;

 use IodogsProduct\Service\ProductService;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class ProductServiceFactory implements FactoryInterface
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
         $objectManager = $serviceLocator->get('Doctrine\ORM\EntityManager');                 
         $imageService = $serviceLocator->get('ImageServiceFactory');
         return new ProductService($objectManager, $imageService);
     }
 }