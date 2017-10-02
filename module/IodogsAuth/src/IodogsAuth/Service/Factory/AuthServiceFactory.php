<?php
namespace IodogsAuth\Service\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\Factory\FactoryInterface,
    IodogsAuth\Service\AuthService,
    Zend\Authentication\AuthenticationService;;

class AuthServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $AuthenticationService = new AuthenticationService();
        return new AuthService($AuthenticationService);
    }


}