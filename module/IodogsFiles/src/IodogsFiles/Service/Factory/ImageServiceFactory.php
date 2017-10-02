<?php
namespace IodogsFiles\Service\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use IodogsFiles\Service\ImageService,
    Zend\ServiceManager\Factory\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;

class ImageServiceFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $om = $container->get("Doctrine\ORM\EntityManager");
        $s3Service = $container->get("S3ServiceFactory");
        return new ImageService($om, $s3Service);
    }


}