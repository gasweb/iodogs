<?php
namespace IodogsFiles\Service\Factory;

use IodogsFiles\Service\S3Service,
    Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Aws\S3\S3Client;;

class S3ServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        if($config['aws'])
        {
            $S3Client = new S3Client($config['aws']);
        }

        return new S3Service($S3Client);
    }
}