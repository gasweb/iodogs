<?php
namespace IodogsFiles\Service\Factory;

use Interop\Container\ContainerInterface;
use IodogsFiles\Service\ImageUploadService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Doctrine\ORM\EntityManager;
use IodogsFiles\Service\S3Service;

class ImageUploadServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $objectManager = $container->get(EntityManager::class);
        $S3Service = $container->get(S3Service::class);
        return new ImageUploadService($objectManager, $S3Service);
    }


}