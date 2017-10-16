<?php
namespace IodogsBreed\Controller\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface,
    IodogsBreed\Controller\BreedController,
    IodogsProduct\Service\ProductService,
    IodogsBreed\Service\BreedService,
    IodogsReview\Service\ReviewService;

class BreedControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $productService = $container->get(ProductService::class);
        $breedService = $container->get(BreedService::class);
        $reviewService = $container->get(ReviewService::class);

        return new BreedController($productService, $breedService, $reviewService);
    }


}