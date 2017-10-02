<?php
namespace IodogsBreed\Service\Factory;

use \Zend\ServiceManager\ServiceLocatorInterface,
    \Zend\ServiceManager\FactoryInterface,
    \IodogsBreed\Service\BreedService;

class BreedServiceFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $om = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $s3Service = $serviceLocator->get('S3ServiceFactory');
        $imageService = $serviceLocator->get('ImageServiceFactory');
        $infoBlockService = $serviceLocator->get('InfoBlockServiceFactory');
        return new BreedService($om, $s3Service, $imageService, $infoBlockService);
    }
}