<?php
namespace IodogsReview\Controller\Factory;

use IodogsReview\Controller\ReviewController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ReviewControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $sl = $serviceLocator->getServiceLocator();
        $om = $sl->get('Doctrine\ORM\EntityManager');
        $reviewService = $sl->get('ReviewServiceFactory');
        return new ReviewController($om, $reviewService);
    }

}