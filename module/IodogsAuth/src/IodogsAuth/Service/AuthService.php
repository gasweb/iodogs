<?php
namespace IodogsAuth\Service;

use IodogsAuth\Adapter\AuthAdapter;


class AuthService
{
    private $zf2AuthService;

    public function __construct($AuthenticationService)
    {
        $this->zf2AuthService = $AuthenticationService;
    }

    public function authenticateByCredentials($login, $password)
    {
        $AuthAdapter = new AuthAdapter($login, $password);
        $AuthResult = $this->zf2AuthService->authenticate($AuthAdapter);
        return $AuthResult;
    }

    public function checkAuth()
    {
        if ($this->zf2AuthService->hasIdentity())
        return true;
        return false;
    }
}