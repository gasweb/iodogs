<?php
namespace IodogsCatalog\Controller\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use IodogsCatalog\Controller\SolutionAdminController;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SolutionAdminControllerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $objectManager = $container->get('Doctrine\ORM\EntityManager');
        $solutionService = $container->get('SolutionServiceFactory');
        return new SolutionAdminController($objectManager, $solutionService);
    }


}