<?php
namespace IodogsCatalog\Service\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use IodogsCatalog\Service\SolutionService;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class SolutionServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $objectManager = $container->get('Doctrine\ORM\EntityManager');
        $infoBlockService = $container->get('InfoBlockServiceFactory');
        return new SolutionService($objectManager, $infoBlockService);
    }


}