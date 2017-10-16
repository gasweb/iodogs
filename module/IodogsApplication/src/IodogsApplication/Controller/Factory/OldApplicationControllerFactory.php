<?php
namespace IodogsApplication\Controller\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use IodogsApplication\Controller\ContentController;
use IodogsApplication\Controller\OldApplicationController;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class OldApplicationControllerFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return OldApplicationController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new OldApplicationController($container);
    }


}