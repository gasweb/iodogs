<?php

namespace IodogsApplication\Service\Cache\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class CacheServiceFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return mixed
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $cacheConfig = array();
        $config = $container->get('Config');
        switch ($requestedName){
            case "IodogsApplication\Service\Cache\Application\ApplicationCacheService":
                if(isset($config['app_cache']))
                    $cacheConfig = $config['app_cache'];
                break;
        }
        return new $requestedName($cacheConfig);
    }
}