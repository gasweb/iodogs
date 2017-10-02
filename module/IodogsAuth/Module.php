<?php
namespace IodogsAuth;

use Zend\Mvc\MvcEvent;

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

    public function onBootstrap(MvcEvent $e) {
        $em = $e->getApplication()->getEventManager();
        $em->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'));
    }

    public function onDispatch(MvcEvent $e)
    {
        $role = "Guest";
        $application = $e->getApplication();
        $routeMatch = $e->getRouteMatch();
        $serviceManager = $application->getServiceManager();
        $authService = $serviceManager->get('AuthServiceFactory');
        $aclService = $serviceManager->get('AclService');
        $controller = $routeMatch->getParam('controller');

        $controller_ = $e->getTarget();

        $action = $routeMatch->getParam('action');
        if($authService->checkAuth())
            $role = "Admin";
        if(!$aclService->isAllowed($role, $controller, $action))
            $controller_->plugin('redirect')->toRoute('login');


    }
}
