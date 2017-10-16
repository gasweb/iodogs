<?php
namespace IodogsReview\Service\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use IodogsReview\Service\ReviewService;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use IodogsBreed\Service\BreedService,
    Doctrine\ORM\EntityManager,
    IodogsProduct\Service\ProductService;

class ReviewServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $objectManager = $container->get(EntityManager::class);
        $breedService = $container->get(BreedService::class);
        $productService = $container->get(ProductService::class);
        return new ReviewService($objectManager, $breedService, $productService);
    }

}