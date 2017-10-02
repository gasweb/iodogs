<?php
namespace IodogsCatalog\Controller\Factory;

 use IodogsCatalog\Controller\LineController; 
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class LineControllerFactory implements FactoryInterface
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
        $LineService = $realServiceLocator->get('LineServiceFactory');


         return new LineController($ProductService, $LineService);
     }
 }