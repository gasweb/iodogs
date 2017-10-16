<?php

namespace IodogsApplication\Service\Cache;

use Zend\Cache\StorageFactory;

abstract class AbstractCacheService
{
    private $cacheService;
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
        $this->checkDir();
        $this->cacheService = StorageFactory::factory($config);
    }

    public function saveCache($key, $content){
        if($key){
            if($this->cacheService->hasItem($key))
                $this->cacheService->replaceItem($key, $content);
            else
                $this->cacheService->setItem($key, $content);
            $this->cacheService->touchItem($key);
        }
    }

    public function loadCache($key){
        if($key && $this->cacheService->hasItem($key))
           return $this->cacheService->getItem($key);
        return null;
    }

    public function clearAll(){
        $this->cacheService->flush();
    }

    private function checkDir(){
        if(isset($this->config['adapter']['options']['cache_dir'])){
            if(!is_dir($this->config['adapter']['options']['cache_dir']))
            {
                mkdir($this->config['adapter']['options']['cache_dir'], 0777, true);
            }
        }
    }

}