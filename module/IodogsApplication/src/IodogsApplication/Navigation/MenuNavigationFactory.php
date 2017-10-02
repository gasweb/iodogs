<?php
namespace IodogsApplication\Navigation;
 
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
 
class MenuNavigationFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $navigation =  new MenuNavigation();
        return $navigation->createService($serviceLocator);
    }
}