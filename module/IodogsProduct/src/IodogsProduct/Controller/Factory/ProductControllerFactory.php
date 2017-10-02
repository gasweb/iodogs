<?php
namespace IodogsProduct\Controller\Factory;

 use Interop\Container\ContainerInterface;
 use Interop\Container\Exception\ContainerException;
 use IodogsProduct\Controller\ProductController;
 //use IodogsProduct\Service\Factory\ProductServiceFactory;
 use Zend\ServiceManager\Exception\ServiceNotCreatedException;
 use Zend\ServiceManager\Exception\ServiceNotFoundException;
 use Zend\ServiceManager\Factory\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class ProductControllerFactory implements FactoryInterface
 {

     public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
     {
         $productService = $container->get('ProductServiceFactory');
         $reviewService = $container->get('ReviewServiceFactory');


         return new ProductController($productService, $reviewService);
     }


 }