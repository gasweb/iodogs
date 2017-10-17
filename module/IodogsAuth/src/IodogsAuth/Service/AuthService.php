<?php
namespace IodogsAuth\Service;

use IodogsAuth\Adapter\AuthAdapter;


class AuthService
{
    /** @var \Zend\Authentication\AuthenticationService $zf2AuthService */
    private $zf2AuthService;

    /** @var \IodogsAuth\Adapter\AuthAdapter $authAdapter */
    private $authAdapter;

    public function __construct($AuthenticationService, $authAdapter)
    {
        $this->zf2AuthService = $AuthenticationService;
        $this->authAdapter = $authAdapter;
    }

    public function authenticateByCredentials($login, $password)
    {
        $this->authAdapter->setLogin($login)->setPassword($password);
        $AuthResult = $this->zf2AuthService->authenticate($this->authAdapter);
        return $AuthResult;
    }

    public function checkAuth()
    {
        if ($this->zf2AuthService->hasIdentity())
        {
            return true;
        }
        return false;
    }
}