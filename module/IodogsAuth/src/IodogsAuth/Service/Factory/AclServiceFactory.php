<?php
namespace IodogsAuth\Service\Factory;

use Interop\Container\ContainerInterface;
use IodogsAuth\Service\AclService;
use Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\Factory\FactoryInterface;

class AclServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new AclService();
    }
}