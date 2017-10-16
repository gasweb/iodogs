<?php
namespace IodogsBreed\Controller\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface,
    IodogsBreed\Controller\AdminBreedController,
    IodogsFiles\Service\ImageUploadService,
    IodogsBreed\Service\BreedService,
    Doctrine\ORM\EntityManager;

class AdminBreedControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $breedService = $container->get(BreedService::class);
        $imageUploadService = $container->get(ImageUploadService::class);
        $om = $container->get(EntityManager::class);

        return new AdminBreedController($om, $breedService, $imageUploadService);
    }


}