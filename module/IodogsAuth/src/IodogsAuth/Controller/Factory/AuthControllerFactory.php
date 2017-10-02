<?php
namespace IodogsAuth\Controller\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface,
    IodogsAuth\Controller\AuthController;

class AuthControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $realSl = $serviceLocator->getServiceLocator();
        $authService = $realSl->get('AuthServiceFactory');
        $aclService = $realSl->get('AclService');
//        $aclService = null;
        return new AuthController($authService, $aclService);
    }

}
