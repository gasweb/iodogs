<?php
namespace IodogsProduct\Service\Factory;

 use Interop\Container\ContainerInterface;
 use Interop\Container\Exception\ContainerException;
 use IodogsProduct\Service\ProductService;
 use Zend\ServiceManager\Exception\ServiceNotCreatedException;
 use Zend\ServiceManager\Exception\ServiceNotFoundException;
 use Zend\ServiceManager\Factory\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 class ProductServiceFactory implements FactoryInterface
 {

     public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
     {
         $objectManager = $container->get('Doctrine\ORM\EntityManager');
         $imageService = $container->get('ImageServiceFactory');
         return new ProductService($objectManager, $imageService);
     }


 }