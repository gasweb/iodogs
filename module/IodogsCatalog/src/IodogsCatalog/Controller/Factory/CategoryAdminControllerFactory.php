<?php
namespace IodogsCatalog\Controller\Factory;

 use Interop\Container\ContainerInterface;
 use Interop\Container\Exception\ContainerException;
 use IodogsCatalog\Controller\CategoryAdminController;
 use Zend\ServiceManager\Exception\ServiceNotCreatedException;
 use Zend\ServiceManager\Exception\ServiceNotFoundException;
 use Zend\ServiceManager\Factory\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;
 use Doctrine\ORM\EntityManager;

 class CategoryAdminControllerFactory implements FactoryInterface
 {

     public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
     {
         $objectManager = $container->get(EntityManager::class);
         return new CategoryAdminController($objectManager);
     }


 }