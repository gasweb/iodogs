<?php
namespace IodogsBreed\Controller\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface,
    IodogsBreed\Controller\BreedController;

class BreedControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $productService = $container->get("ProductServiceFactory");
        $breedService = $container->get("BreedServiceFactory");
        $reviewService = $container->get("ReviewServiceFactory");

        return new BreedController($productService, $breedService, $reviewService);
    }


}