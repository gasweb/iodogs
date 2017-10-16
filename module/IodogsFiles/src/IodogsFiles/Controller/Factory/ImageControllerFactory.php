<?php
namespace IodogsFiles\Controller\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use IodogsFiles\Controller\ImageController,
    Zend\ServiceManager\Factory\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;
use IodogsFiles\Service\ImageService;
use Doctrine\ORM\EntityManager;

class ImageControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $ImageService = $container->get(ImageService::class);
        $om = $container->get(EntityManager::class);
        return new ImageController ($ImageService, $container, $om);
    }


}