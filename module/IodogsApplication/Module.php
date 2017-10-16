<?php
namespace IodogsApplication;

use Zend\Mvc\MvcEvent;
use IodogsApplication\Service\Cache\Application\ApplicationCacheService;
use Zend\ModuleManager\ModuleManager;

class Module
{

    /**
     * Sets listeners for events
     *
     * @param ModuleManager $manager
     */
    public function init(ModuleManager $manager)
    {
        if (!$this->isConsoleRequest()) {
            // Get event manager.
            $eventManager = $manager->getEventManager();
            $sharedEventManager = $eventManager->getSharedManager();
            // Register the event listener method.
            $sharedEventManager->attach(\Zend\Mvc\Application::class, MvcEvent::EVENT_DISPATCH,
                [$this, 'loadRouteCache'], 20);
            $sharedEventManager->attach(\Zend\Mvc\Application::class, MvcEvent::EVENT_ROUTE,
                [$this, 'setResponseHeaders'], 10);
            $sharedEventManager->attach(\Zend\Mvc\Application::class, MvcEvent::EVENT_FINISH,
                [$this, 'saveRouteCache'], -1);
            $sharedEventManager->attach(\Zend\Mvc\Application::class, MvcEvent::EVENT_DISPATCH_ERROR,
                [$this, 'onError'], 100);
        }

    }

    /**
     * On Error log into file
     *
     * @param MvcEvent $event
     */
    public function onError(MvcEvent $event)
    {
        $exceptionName = '';
        $stackTrace = '';
        $line = '';
        $file = '';
        // Get the exception information.
        $exception = $event->getParam('exception');
        if ($exception!=null) {
            $exceptionName = $exception->getMessage();
            $file = $exception->getFile();
            $line = $exception->getLine();
            $stackTrace = $exception->getTraceAsString();
        }
        $errorMessage = $event->getError();
        $controllerName = $event->getController();

        // Prepare email message.
//        $to = 'big-papa@mail.ru';
//        $subject = 'Your Website Exception';

        $body = '';
        if(isset($_SERVER['REQUEST_URI'])) {
            $body .= "Request URI: " . $_SERVER['REQUEST_URI'] . "\n\n";
        }
        $body .= "Controller: $controllerName\n";
        $body .= "Error message: $errorMessage\n";
        if ($exception!=null) {
            $body .= "Exception: $exceptionName\n";
            $body .= "File: $file\n";
            $body .= "Line: $line\n";
            $body .= "Stack trace:\n\n" . $stackTrace;
        }

        $body = str_replace("\n", "<br>", $body);
        $logger = new \Zend\Log\Logger();
        $logger->addWriter(new \Zend\Log\Writer\Stream('data/log/error.log'));
        $logger->info($body);

        // Send an email about the error.
//        mail($to, $subject, $body);
    }

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

    /**
     * @access public
     *
     * @param MvcEvent $event
     * @return \Zend\Stdlib\ResponseInterface
     */
    public function loadRouteCache(MvcEvent $event){
        $routeMatch = $event->getRouteMatch();
        $cacheKey = $this->getCacheKey($routeMatch);
        $container = $event->getApplication()->getServiceManager();
        if($cacheKey){
            /** @var \IodogsApplication\Service\Cache\Application\ApplicationCacheService $AppCacheService */
            $AppCacheService = $container->get(ApplicationCacheService::class);
            $cache = $AppCacheService->loadCache($cacheKey);
            if($cache){
                $response = $event->getResponse();
                $response->setContent($cache['content']);
                if(isset($cache['headers']) && is_array($cache['headers'])){
                    foreach ($cache['headers'] as $header => $value) {
                        $response->getHeaders()->addHeaderLine($header, $value);
                    }
                }
                return $response;
            }
        }
    }

    /**
     * @access public
     *
     * Sets cache
     *
     * @param MvcEvent $event
     */
    public function saveRouteCache(MvcEvent $event){
        $routeMatch = $event->getRouteMatch();
        $cacheKey = $this->getCacheKey($routeMatch);
        $container = $event->getApplication()->getServiceManager();
        $request = $event->getRequest();
        if ($request->isPost()){
            return;
        }

        /** @var \IodogsApplication\Service\Cache\Application\ApplicationCacheService $AppCacheService */
        $AppCacheService = $container->get(ApplicationCacheService::class);
        $cache = $AppCacheService->loadCache($cacheKey);
        if($cacheKey && !$cache){
            $response = $event->getResponse();
            $status = $response->getStatusCode();
            if($status == 200)
            {
                $headers = $response->getHeaders()->toArray();
                $cacheContent = array(
                    'content' => $response->getContent(),
                    'headers' => $headers
                );
                $AppCacheService->saveCache($cacheKey, $cacheContent);
            }
        }
    }

    /**
     * @access private
     *
     * Gets cache key
     *
     * @param $routeMatch
     * @return null|string
     */
    private function getCacheKey($routeMatch){
        $cacheKey = null;
        if($routeMatch){
            $params = $routeMatch->getParams();

            if(isset($params['cache']) && $params['cache'] === false)
            {
                return null;
            }

            $matchedRouteName = $routeMatch->getMatchedRouteName();
            if(!empty($matchedRouteName)){
                $cacheKey = str_replace("/", "_", $matchedRouteName);

                if(isset($params['slug']) && !empty($params['slug'])){
                    $cacheKey .= '-'.$params['slug'];
                }
            }
        }
        return $cacheKey;
    }

    /**
     * Sets response headers for all requests
     * @param MvcEvent $event
     */
    public function setResponseHeaders(MvcEvent $event)
    {
        $response = $event->getResponse();
        $dateUpdate = new \DateTime('today midnight');
        $dateUpdate->setTimeZone(new \DateTimeZone("GMT-0"));
        $response->getHeaders()->addHeaderLine('Expires', date("D, j M Y", strtotime("tomorrow")) . " 02:00:00 GMT");
        $response->getHeaders()->addHeaderLine('Last-Modified', $dateUpdate->format('D, d M Y H:i:s \G\M\T'));
        $response->getHeaders()->addHeaderLine('Access-Control-Allow-Origin', '*');
    }

    private function isConsoleRequest()
    {
        if (php_sapi_name() == 'cli') {
            return true;
        }
        return false;
    }
}
