<?php
namespace IodogsReview\Controller\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use IodogsReview\Controller\ApplicationController;
use IodogsReview\Service\Factory\ReviewServiceFactory;
use IodogsReview\Service\ReviewService;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $om = $container->get('Doctrine\ORM\EntityManager');
        $reviewService = $container->get(ReviewService::class);
        return new ApplicationController($om, $reviewService);
    }
}