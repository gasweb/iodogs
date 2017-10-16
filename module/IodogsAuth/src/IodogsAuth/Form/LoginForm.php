<?php
namespace IodogsAuth\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Password;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct('login-form');
        $this->init();
    }

    public function init()
    {
        $this->add([
            'name' => 'user_name',
            'type' => Text::class,
            'options' => [
                'label' => 'Имя пользователя'
            ],
            'attributes' => [
                'placeholder' => 'Введите имя пользователя',
                'autocomplete' => 'off'
            ],
        ]);

        $this->add([
            'name' => 'password',
            'type' => Password::class,
            'options' => [
                'label' => 'Пароль'
            ],
            'attributes' => [
                'placeholder' => 'Введите пароль',
                'autocomplete' => 'off'
            ],
        ]);

        $this->add([
            'name' => 'csrf',
            'type' => Csrf::class,
            'options' => [
                'csrf_options' => [
                    'timeout' => 60
                ]
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Войти',
                'id' => 'submitbutton',
                'class' => 'btn-success'
            ],
        ]);
    }
}