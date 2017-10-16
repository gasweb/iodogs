<?php

namespace IodogsApplication\Service\Cache\Application;


use IodogsApplication\Service\Cache\AbstractCacheService;

class ApplicationCacheService extends AbstractCacheService
{
    public function __construct($config)
    {
        parent::__construct($config);
    }
}