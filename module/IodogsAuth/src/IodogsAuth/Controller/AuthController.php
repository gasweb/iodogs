<?php

namespace IodogsAuth\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\EventManager\EventManagerInterface;
use IodogsAuth\Form\LoginForm;

class AuthController extends AbstractActionController
{
    /**
     * @var \IodogsAuth\Service\AuthService
     */
    private $authService;

    /**
     * @var \IodogsAuth\Service\Acl
     */
    private $aclService;

    public function __construct($authService, $aclService)
    {
        $this->authService = $authService;
        $this->aclService = $aclService;
    }

    public function loginAction()
    {
        if($this->authService->checkAuth())
            $this->redirect()->toRoute('app/backoffice');
        
        $request = $this->getRequest();
        if($request->isPost())
        {
            $result = $this->authService->authenticateByCredentials($request->getPost('user_name'), $request->getPost('password'));
            if($result->getCode() == 1)
                $this->redirect()->toRoute('app/backoffice');
        }
        $LoginForm = new LoginForm();

        return array(
            'loginForm' => $LoginForm
        );
    }

    public function successAction()
    {
        //$aclService = $this->getServiceLocator()->get('AclService');
//        print_r($aclService);
        /*if($this->authService->checkAuth())
            return new ViewModel();
        $this->redirect()->toRoute('login');*/
//        $list = $this->aclService->getRightLists();
        //$roles = $this->aclService->getRoles();
       // $resources = $this->aclService->getResources();
//        print_r($roles);
//        print_r($list);
//        print_r($resources);
        //if($this->aclService->isAllowed('Guest', 'ContentController', 'slug'))
          //  echo 'yes'; else echo "no";

    }

    public function setEventManager(EventManagerInterface $events)
    {
        parent::setEventManager($events);
        $controller = $this;
        $events->attach('dispatch', function ($e) use ($controller) {
            $controller->layout('layout/layout-login');
        }, 100);
    }

}

