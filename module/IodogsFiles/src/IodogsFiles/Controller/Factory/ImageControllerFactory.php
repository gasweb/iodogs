<?php
namespace IodogsFiles\Controller\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use IodogsFiles\Controller\ImageController,
    Zend\ServiceManager\Factory\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;

class ImageControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $ImageService = $container->get("ImageServiceFactory");
        $om = $container->get("Doctrine\ORM\EntityManager");
        return new ImageController ($ImageService, $realServiceLocator, $om);
    }


}