<?php
namespace IodogsProduct\Controller\Factory;

 use Interop\Container\ContainerInterface;
 use Interop\Container\Exception\ContainerException;
 use IodogsProduct\Controller\ProductAdminController;
 use Zend\ServiceManager\Exception\ServiceNotCreatedException;
 use Zend\ServiceManager\Exception\ServiceNotFoundException;
 use Zend\ServiceManager\Factory\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 use IodogsProduct\Service\ProductService,
     Doctrine\ORM\EntityManager;

 class ProductAdminControllerFactory implements FactoryInterface
 {
     public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
     {
         $objectManager = $container->get(EntityManager::class);
         $productService = $container->get(ProductService::class);
         return new ProductAdminController($objectManager, $productService);
     }


 }