<?php
namespace IodogsBreed\Service\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface,
    IodogsBreed\Service\BreedService;
use IodogsFiles\Service\S3Service;
use Doctrine\ORM\EntityManager;
use IodogsFiles\Service\ImageService;
use IodogsApplication\Service\InfoBlockService;

class BreedServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $om = $container->get(EntityManager::class);
        $s3Service = $container->get(S3Service::class);
        $imageService = $container->get(ImageService::class);
        $infoBlockService = $container->get(InfoBlockService::class);
        return new BreedService($om, $s3Service, $imageService, $infoBlockService);
    }

}