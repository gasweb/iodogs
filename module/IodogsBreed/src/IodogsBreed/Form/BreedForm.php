<?php
namespace IodogsBreed\Form;

/*use Zend\Form\Form,
    Zend\Stdlib\Hydrator\ClassMethods;*/

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;
use IodogsApplication\Strategy\InfoBlockStrategy;

class BreedForm extends Form implements ObjectManagerAwareInterface
    {
        public function __construct(ObjectManager $objectManager)
        {

            $this->setObjectManager($objectManager);
            $this->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
            $hydrator = $this->getHydrator();
            $hydrator->addStrategy('info_block', new InfoBlockStrategy($objectManager));

            parent::__construct('breed-form');

            $this->add(array(
                'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                'name' => 'info_block',
                'options' => array(
                    'object_manager' => $objectManager,
                    'target_class'   => 'IodogsDoctrine\Entity\InfoBlock',
                    'property'       => 'header',
                    'label'       => 'Информационный блок',
                    'is_method'      => true,
                    'empty_option'   => 'Выберите инфоблок',
                    'find_method'    => array(
                        'name'   => 'findBy',
                        'params' => array(
                            'criteria' => array(),
                            'orderBy'  => array('id' => 'ASC'),
                        ),
                    ),
                ),
            ));

            $this->add(array(
                'name' => 'rus_title',
                'type' => 'Text',
                'options' => array(
                    'property' => 'rusTitle',
                    'label' => 'Рус. название породы',
                ),
                'attributes' => array(
                    'placeholder' => 'Введите название породы на русском',
                    'autocomplete' => 'off'
                ),
            ));

            $this->add(array(
                'name' => 'eng_title',
                'type' => 'Text',
                'options' => array(
                    'label' => 'Англ. название породы',
                ),
                'attributes' => array(
                    'placeholder' => 'Введите название породы на англ.',
                    'autocomplete' => 'off'
                ),
            ));

             $this->add(array(
                'name' => 'slug',
                'type' => 'Text',
                'options' => array(
                    'label' => 'alias для url breed/alias',
                ),
                'attributes' => array(
                    'placeholder' => 'Введите alias',
                    'autocomplete' => 'off'
                ),
            ));

            $this->add(array(
                'name' => 'submit',
                'type' => 'Submit',
                'attributes' => array(
                    'value' => 'Сохранить',
                    'id' => 'submitbutton',
                    'class' => 'btn-success'
                ),
            ));
}
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;

        return $this;
    }

    public function getObjectManager()
    {
        return $this->objectManager;
    }
}    