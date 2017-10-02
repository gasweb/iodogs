<?php
namespace IodogsApplication\Navigation\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use IodogsApplication\Navigation\ProductNavigation;

class ProductNavigationFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $navigation =  new ProductNavigation();
        return $navigation->createService($serviceLocator);
    }
}