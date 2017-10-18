<?php
namespace IodogsApplication\Service\Mail;

use Interop\Container\ContainerInterface;
use IodogsApplication\Service\Mail\Transport\TransportService;
use Zend\ServiceManager\Factory\FactoryInterface;

class MailServiceFactory implements FactoryInterface
{

    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return MailService
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $transportService = $container->get(TransportService::class);
        return new MailService($transportService, $container->get('Config')['mail']);
    }


}