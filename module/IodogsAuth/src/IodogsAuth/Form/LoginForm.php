<?php
namespace IodogsAuth\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct()
    {
        parent::__construct('login-form');

        $this->add(array(
            'name' => 'user_name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Имя пользователя'
            ),
            'attributes' => array(
                'placeholder' => 'Введите имя пользователя',
                'autocomplete' => 'off'
            ),
        ));

        $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'options' => array(
                'label' => 'Пароль'
            ),
            'attributes' => array(
                'placeholder' => 'Введите пароль',
                'autocomplete' => 'off'
            ),
        ));
        
        $this->add(array(
            'name' => 'password',
            'type' => 'Password',
            'options' => array(
                'label' => 'Пароль'
            ),
            'attributes' => array(
                'placeholder' => 'Введите пароль',
                'autocomplete' => 'off'
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 60
                )
            )
        ));


        $this->add([
            'type' => 'Captcha',
            'name' => 'captcha',
            'options' => [
                'label' => 'Введите символы: ',
                'captcha' => [
                    'class'   => 'Dumb',
                    'options' => [
                        'wordLen' => 4,
                    ],
                ],
            ],
        ]);


        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Войти',
                'id' => 'submitbutton',
                'class' => 'btn-success'
            ),
        ));

    }
}