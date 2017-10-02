<?php
namespace IodogsApplication\Form;

use Zend\Form\Form,
    Zend\Stdlib\Hydrator\ClassMethods;

class ContactForm extends Form
{
    public function __construct()
    {
        $this->setHydrator(new ClassMethods);
        parent::__construct('wholeSaleForm');
        
        $this->add(array(
            'name' => 'email',
            'type' => 'Email',
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                'placeholder' => 'Введите email',
                'autocomplete' => 'off'
                ),
            )
        );

        $this->add(array(
            'name' => 'name',
            'type' => 'Text',
            'options' => array(
                'label' => 'Имя',
            ),
            'attributes' => array(
                'placeholder' => 'Введите имя',
                'autocomplete' => 'off'
                ),
            )
        );

        $this->add(array(
                'name' => 'header',
                'type' => 'Text',
                'options' => array(
                    'label' => 'Тема',
                ),
                'attributes' => array(
                    'placeholder' => 'Введите тему обращения',
                    'autocomplete' => 'off'
                ),
            )
        );

        $this->add(array(
            'name' => 'phone',
            'type' => 'Text',
            'options' => array(
                'label' => 'Телефон',
            ),
            'attributes' => array(
                'placeholder' => 'Введите телефон',
                'autocomplete' => 'off'
                ),
            )
        );



        $this->add(array(
            'name' => 'message',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Сообщение',
            ),
            'attributes' => array(
                'rows' => 5
            ),
        ));

        $this->add(array(
            'name' => 'csrf',
            'type' => 'Csrf',
            'options' => array(
                'csrf_options' => array(
                    'timeout' => 600
                )
            )
        ));

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Отправить',
                'id' => 'submitbutton',
                'class' => 'btn-success'
            ),
        ));
    }
}
