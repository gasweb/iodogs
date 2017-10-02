<?php
namespace IodogsApplication\Form;

    use DoctrineModule\Persistence\ObjectManagerAwareInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use Zend\Form\Form;

        class ConfirmForm extends Form 
        {
            public function __construct()
            {               
                parent::__construct('confirm-form');
                /*$this->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                $hydrator = $this->getHydrator(); */                                                                           
                 
                $this->add(array(
                    'name' => 'confirm-yes',
                    'type' => 'Submit',
                    'attributes' => array(
                        'value' => 'Yes',
                        'id' => 'yes-button',
                        'class' => 'btn-success'
                    ),
                ));
                $this->add(array(
                    'name' => 'confirm-no',
                    'type' => 'Submit',
                    'attributes' => array(
                        'value' => 'No',
                        'id' => 'no-button',
                        'class' => 'btn-danger'
                    ),
                ));

    }    
}