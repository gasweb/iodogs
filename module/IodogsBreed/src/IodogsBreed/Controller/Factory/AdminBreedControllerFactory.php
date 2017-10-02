<?php
namespace IodogsBreed\Controller\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface,
    IodogsBreed\Controller\AdminBreedController;

class AdminBreedControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $breedService = $container->get("BreedServiceFactory");
        $imageUploadService = $container->get("ImageUploadServiceFactory");
        $om = $container->get('Doctrine\ORM\EntityManager');

        return new AdminBreedController($om, $breedService, $imageUploadService);
    }


}