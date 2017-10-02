<?php
namespace IodogsFiles\Service\Factory;

use IodogsFiles\Service\ImageService,
    Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class ImageServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $om = $serviceLocator->get("Doctrine\ORM\EntityManager");
        $s3Service = $serviceLocator->get("S3ServiceFactory");
        return new ImageService($om, $s3Service);
    }
}