<?php
namespace IodogsApplication\Service\Mail\Transport;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class TransportServiceFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return TransportService
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new TransportService($container->get('Config')['mail']);
    }


}