<?php
namespace IodogsCatalog\Controller\Factory;

 use IodogsCatalog\Controller\CatalogController;
 //use IodogsProduct\Service\Factory\ProductServiceFactory;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class CatalogControllerFactory implements FactoryInterface
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
        $CatalogService = $realServiceLocator->get('CatalogServiceFactory');
        $ProductService = $realServiceLocator->get('ProductServiceFactory');


         return new CatalogController($CatalogService, $ProductService, $realServiceLocator);
     }
 }