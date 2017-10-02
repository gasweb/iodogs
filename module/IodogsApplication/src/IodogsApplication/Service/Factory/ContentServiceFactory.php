<?php
namespace IodogsApplication\Service\Factory;

use Interop\Container\ContainerInterface;
use IodogsApplication\Service\ContentService;
use Zend\ServiceManager\Factory\FactoryInterface;

class ContentServiceFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return ContentService
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $objectManager = $container->get('Doctrine\ORM\EntityManager');
        return new ContentService($objectManager);
    }


}