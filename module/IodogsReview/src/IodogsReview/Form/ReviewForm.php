<?php
namespace IodogsReview\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use IodogsBreed\Strategy\BreedReviewStrategy;
use IodogsProduct\Form\ProductReviewFieldset;
use Zend\Form\Form;
use Zend\Hydrator\ClassMethods;

class ReviewForm extends Form implements ObjectManagerAwareInterface
{
    private $om;

    public function __construct($objectManager)
    {
        $this->setObjectManager($objectManager);
      parent::__construct('review-form');
        $this->setAttribute('action', '/review/add');
        $this->setHydrator(new ClassMethods());
        $hydrator = $this->getHydrator();
        $hydrator->addStrategy('breed', new BreedReviewStrategy($this->om));
        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'breed',
            'options' => array(
                'object_manager' => $this->om,
                'target_class'   => 'IodogsDoctrine\Entity\Breed',
                'property'       => 'rusTitle',
                'label'       => 'Порода',
                'is_method'      => true,
                'empty_option'   => 'Выберите породу',
                'find_method'    => array(
                    'name'   => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy'  => array('rusTitle' => 'ASC'),
                    ),
                ),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'product',
            'attributes' => array(
                'class' => 'product-set',
            ),
            'options' => array(
                'label' => 'Использованные средства',
                'count' => 1,
                'multiple' => true,
                'should_create_template' => true,
                'allow_add' => true,
                /*'template_placeholder' => '__product__',*/
                'target_element' => new ProductReviewFieldset($objectManager)
            ),
        ));

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
        ));

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
        ));

        $this->add(array(
            'name' => 'city_entered',
            'type' => 'Text',
            'options' => array(
                'label' => 'Город',
            ),
            'attributes' => array(
                'placeholder' => 'Введите город',
                'autocomplete' => 'off'
            ),
        ));



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
        ));

        $this->add(array(
            'name' => 'review',
            'type' => 'Textarea',
            'options' => array(
                'label' => 'Отзыв',
            ),
            'attributes' => array(
                'placeholder' => 'Текст отзыва',
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

    public function getObjectManager()
    {
        return $this->om;
    }

    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->om = $objectManager;
        return $this;
    }


}