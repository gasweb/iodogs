<?php
namespace IodogsAuth\Service\Factory;

use Zend\ServiceManager\ServiceLocatorInterface,
    Zend\ServiceManager\FactoryInterface,
    IodogsAuth\Service\AuthService,
    Zend\Authentication\AuthenticationService;;

class AuthServiceFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $AuthenticationService = new AuthenticationService();
        return new AuthService($AuthenticationService);
    }
}