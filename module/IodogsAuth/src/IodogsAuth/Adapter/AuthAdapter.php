<?php
namespace IodogsAuth\Adapter;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result AS AuthResult;

class AuthAdapter implements AdapterInterface
{
    
    private $userName;

    private $password;

    public function __construct($userName, $password)
    {
        $this->userName = $userName;
        $this->password = $password;

    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        if($this->userName=="gas" && $this->password == "!Web7895123")
            return new AuthResult(AuthResult::SUCCESS, $this->userName);
        else
            return new AuthResult(AuthResult::FAILURE_IDENTITY_NOT_FOUND, null);

        /* Return if can't find user */
//        return new AuthResult(AuthResult::FAILURE_IDENTITY_NOT_FOUND, null);
        /* Return if success, second parameter is the identity, e.g user. */
//        return new AuthResult(AuthResult::SUCCESS, $identity);
        /* Return if user found, but credentials were invalid */
//        return new AuthResult(AuthResult::FAILURE_CREDENTIAL_INVALID, null);
    }
}