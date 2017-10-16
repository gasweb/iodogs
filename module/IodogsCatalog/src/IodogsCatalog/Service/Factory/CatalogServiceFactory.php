<?php
namespace IodogsCatalog\Service\Factory;

 use Interop\Container\ContainerInterface;
 use Interop\Container\Exception\ContainerException;
 use IodogsCatalog\Service\CatalogService;
 use Zend\ServiceManager\Exception\ServiceNotCreatedException;
 use Zend\ServiceManager\Exception\ServiceNotFoundException;
 use Zend\ServiceManager\Factory\FactoryInterface;
 use Zend\ServiceManager\ServiceLocatorInterface;
 use IodogsApplication\Service\InfoBlockService;
 use Doctrine\ORM\EntityManager;

 class CatalogServiceFactory implements FactoryInterface
 {

     public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
     {
         $objectManager = $container->get(EntityManager::class);
         $infoBlockService = $container->get(InfoBlockService::class);
         return new CatalogService($objectManager, $infoBlockService);
     }


 }