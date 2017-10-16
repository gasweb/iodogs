<?php
namespace IodogsProduct\Service\Factory;

 use Interop\Container\ContainerInterface;
 use Interop\Container\Exception\ContainerException;
 use IodogsProduct\Service\ProductService;
 use Zend\ServiceManager\Exception\ServiceNotCreatedException;
 use Zend\ServiceManager\Exception\ServiceNotFoundException;
 use Zend\ServiceManager\Factory\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;
 use IodogsFiles\Service\ImageService;
 use Doctrine\ORM\EntityManager;

 class ProductServiceFactory implements FactoryInterface
 {

     public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
     {
         $objectManager = $container->get(EntityManager::class);
         $imageService = $container->get(ImageService::class);
         return new ProductService($objectManager, $imageService);
     }
 }