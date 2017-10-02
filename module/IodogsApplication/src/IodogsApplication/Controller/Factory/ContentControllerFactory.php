<?php
namespace IodogsApplication\Controller\Factory;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use IodogsApplication\Controller\ContentController;
//use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContentControllerFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ContentController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $ContentService = $container->get('ContentServiceFactory');
        return new ContentController($ContentService, $container);
    }


}