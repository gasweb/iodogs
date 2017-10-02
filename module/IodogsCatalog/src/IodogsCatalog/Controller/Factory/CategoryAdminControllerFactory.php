<?php
namespace IodogsCatalog\Controller\Factory;

 use IodogsCatalog\Controller\CategoryAdminController;
 use Zend\ServiceManager\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class CategoryAdminControllerFactory implements FactoryInterface
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
        return new CategoryAdminController($objectManager);
     }
 }