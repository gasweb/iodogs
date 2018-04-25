<?php
namespace IodogsFiles\Service\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use IodogsFiles\Service\S3Service,
    Zend\ServiceManager\Factory\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    Aws\S3\S3Client;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;

class S3ServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('config');
        if(isset($config['aws']) && $config['aws'])
        {
            $S3Client = new S3Client($config['aws']);
        }

        return new S3Service($S3Client);
    }
}