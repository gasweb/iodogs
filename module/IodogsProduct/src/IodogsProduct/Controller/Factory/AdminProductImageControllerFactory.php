<?php
namespace IodogsProduct\Controller\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use IodogsProduct\Controller\AdminProductImageController;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use IodogsFiles\Service\ImageUploadService,
    Doctrine\ORM\EntityManager,
    IodogsProduct\Service\ProductService;

class AdminProductImageControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $objectManager = $container->get(EntityManager::class);
        $imageUploadService = $container->get(ImageUploadService::class);
        $productService = $container->get(ProductService::class);

        return new AdminProductImageController($objectManager, $imageUploadService, $productService);
    }


}
