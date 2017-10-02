<?php
namespace IodogsCatalog\Controller\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use IodogsCatalog\Controller\SolutionController;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SolutionControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $ProductService = $container->get('ProductServiceFactory');
        $SolutionService = $container->get('SolutionServiceFactory');


        return new SolutionController($ProductService, $SolutionService);
    }


}