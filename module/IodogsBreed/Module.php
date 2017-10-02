<?php
namespace IodogsBreed;

use \Zend\ModuleManager\ModuleManager;

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

    public function init(ModuleManager $manager)
    {

        $events = $manager->getEventManager();
        $sharedEvents = $events->getSharedManager();
        $sharedEvents->attach(__NAMESPACE__, 'dispatch', function($e) {
            $adminControllers = array(
                'IodogsBreed\Controller\AdminBreedController'
            );
            $controller = $e->getTarget();
            if (in_array(get_class($controller), $adminControllers)){
                $controller->layout('layout/layout-admin');
            }
        }, 100);
    }
}
