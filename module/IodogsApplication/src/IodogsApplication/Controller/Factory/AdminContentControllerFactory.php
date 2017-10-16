<?php
namespace IodogsApplication\Controller\Factory;

use Interop\Container\ContainerInterface;
use IodogsApplication\Controller\AdminContentController;
use Zend\ServiceManager\Factory\FactoryInterface;
use Doctrine\ORM\EntityManager;

class AdminContentControllerFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return AdminContentController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get(EntityManager::class);
        return new AdminContentController($entityManager);
    }
}