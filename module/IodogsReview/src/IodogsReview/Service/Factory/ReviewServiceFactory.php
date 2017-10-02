<?php
namespace IodogsReview\Service\Factory;

use IodogsReview\Service\ReviewService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ReviewServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $objectManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $breedService = $serviceLocator->get('BreedServiceFactory');
        $productService = $serviceLocator->get('ProductServiceFactory');
        return new ReviewService($objectManager, $breedService, $productService);
    }
}