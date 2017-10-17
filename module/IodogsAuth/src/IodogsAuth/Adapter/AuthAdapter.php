<?php
namespace IodogsAuth\Adapter;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result AS AuthResult;

class AuthAdapter implements AdapterInterface
{
    /** @var array $credentials */
    private $credentials;

    private $login = null;
    private $password = null;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     * @return AuthAdapter
     */
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return AuthAdapter
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        if($this->credentials && $this->getLogin() && $this->getPassword())
        {
            foreach ($this->credentials as $credential) {
                if ($credential['login'] && $credential['password'] && $credential['login'] === $this->getLogin() && $credential['password'] === $this->getPassword())
                {
                    return new AuthResult(AuthResult::SUCCESS, $this->login);
                }
            }
        }

        return new AuthResult(AuthResult::FAILURE_IDENTITY_NOT_FOUND, null);

        /* Return if can't find user */
//        return new AuthResult(AuthResult::FAILURE_IDENTITY_NOT_FOUND, null);
        /* Return if success, second parameter is the identity, e.g user. */
//        return new AuthResult(AuthResult::SUCCESS, $identity);
        /* Return if user found, but credentials were invalid */
//        return new AuthResult(AuthResult::FAILURE_CREDENTIAL_INVALID, null);
    }
}