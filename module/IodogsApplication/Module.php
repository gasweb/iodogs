<?php
namespace IodogsApplication;

use \Zend\Mvc\MvcEvent;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function onBootstrap(MvcEvent $e)
    {
        // A list of routes to be cached
        $routes = array('app/breed');

        $app = $e->getApplication();
        $em  = $app->getEventManager();
//        $sm  = $app->getServiceManager();


        $em->attach(MvcEvent::EVENT_ROUTE, array($this, 'loadCache'), -1000);
        $em->attach(MvcEvent::EVENT_RENDER, array($this, 'saveCache'), -10000);

    }

    public function saveCache(MvcEvent $event)
    {
        $sm = $event->getApplication()->getServiceManager();
        $response = $event->getResponse();
        $content  = $response->getContent();
        $cache = $sm->get('IodogsCacheService');
        $key = $this->getCacheKey($event);
        if($key)
            $cache->setItem($key, $content);
        return;
    }

    public function loadCache(MvcEvent $event)
    {
        $sm = $event->getApplication()->getServiceManager();
        $cache = $sm->get('IodogsCacheService');
        $key = $this->getCacheKey($event);
        if ($key && $cache->hasItem($key)) {
            $this->getResponseHeaders($event);
            $content  = $cache->getItem($key);
            $response = $event->getResponse();
            $response->setContent($content);
            return $response;
        }
        return;
    }

    public function getCacheKey(MvcEvent $event)
    {
        $key = null;
        $routeMatch = $event->getRouteMatch();
        if ($routeMatch)
        {
            $params = $routeMatch->getParams();
            $routeName = $routeMatch->getMatchedRouteName();
            if(strpos($routeName, 'old') || strpos($routeName, 'admin')  || strpos($routeName, 'login')  || strpos($routeName, 'contacts'))
                return $key;

            $key   = 'route-cache-' . $routeName;
            $key = str_replace('/', '-', $key);
            if(!empty($params['slug']))
                $key .= '-'.$params['slug'];
        }

        return $key;
    }

    public function getResponseHeaders($event)
    {
        $response = $event->getResponse();
        $dateUpdate = new \DateTime('today midnight');
        $dateUpdate->setTimeZone(new \DateTimeZone("GMT-0"));
        $response->getHeaders()->addHeaderLine('Expires', date("D, j M Y", strtotime("tomorrow")) . " 02:00:00 GMT");
        $response->getHeaders()->addHeaderLine('Last-Modified', $dateUpdate->format('D, d M Y H:i:s \G\M\T'));
    }
}
