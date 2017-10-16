<?php
namespace IodogsCatalog\Controller\Factory;

 use Interop\Container\ContainerInterface;
 use Interop\Container\Exception\ContainerException;
 use IodogsCatalog\Controller\CatalogController;
 //use IodogsProduct\Service\Factory\ProductServiceFactory;
 use Zend\ServiceManager\Exception\ServiceNotCreatedException;
 use Zend\ServiceManager\Exception\ServiceNotFoundException;
 use Zend\ServiceManager\Factory\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;

 use IodogsCatalog\Service\CatalogService,
     IodogsProduct\Service\ProductService;

 class CatalogControllerFactory implements FactoryInterface
 {

     public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
     {
         $CatalogService = $container->get(CatalogService::class);
         $ProductService = $container->get(ProductService::class);


         return new CatalogController($CatalogService, $ProductService, $container);
     }


 }