<?php
namespace IodogsProduct\Controller\Factory;

 use Interop\Container\ContainerInterface;
 use Interop\Container\Exception\ContainerException;
 use IodogsProduct\Controller\ProductAdminController;
 use Zend\ServiceManager\Exception\ServiceNotCreatedException;
 use Zend\ServiceManager\Exception\ServiceNotFoundException;
 use Zend\ServiceManager\Factory\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class ProductAdminControllerFactory implements FactoryInterface
 {
     public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
     {
         $objectManager = $container->get('Doctrine\ORM\EntityManager');
         $productService = $container->get('ProductServiceFactory');
         return new ProductAdminController($objectManager, $productService);
     }


 }