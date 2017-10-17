<?php
namespace IodogsAuth\Adapter;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result AS AuthResult;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthAdapterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $credentials = [];
        $config = $container->get('config');
        if (is_array($config) && isset($config['backoffice']['credentials']))
        {
            $credentials = $config['backoffice']['credentials'];
        }
        return new AuthAdapter($credentials);
    }


}