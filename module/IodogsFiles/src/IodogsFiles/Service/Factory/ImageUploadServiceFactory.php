<?php
namespace IodogsFiles\Service\Factory;

use IodogsFiles\Service\ImageUploadService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ImageUploadServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $objectManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $S3Service = $serviceLocator->get('S3ServiceFactory');
        return new ImageUploadService($objectManager, $S3Service);
    }
}