<?php
namespace IodogsReview\Service\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use IodogsReview\Service\ReviewService;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ReviewServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $objectManager = $container->get('Doctrine\ORM\EntityManager');
        $breedService = $container->get('BreedServiceFactory');
        $productService = $container->get('ProductServiceFactory');
        return new ReviewService($objectManager, $breedService, $productService);
    }

}