<?php
namespace IodogsAuth\Controller\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    IodogsAuth\Controller\AuthController;

class AuthControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $authService = $container->get('AuthServiceFactory');
        $aclService = $container->get('AclService');
//        $aclService = null;
        return new AuthController($authService, $aclService);
    }


}
