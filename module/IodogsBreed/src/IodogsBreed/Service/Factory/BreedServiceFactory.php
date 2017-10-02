<?php
namespace IodogsBreed\Service\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface,
    IodogsBreed\Service\BreedService;

class BreedServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $om = $container->get('Doctrine\ORM\EntityManager');
        $s3Service = $container->get('S3ServiceFactory');
        $imageService = $container->get('ImageServiceFactory');
        $infoBlockService = $container->get('InfoBlockServiceFactory');
        return new BreedService($om, $s3Service, $imageService, $infoBlockService);
    }

}