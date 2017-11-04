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
      parent::__construct('application-form');
        $this->setAttribute('action', '/application/add');
        $this->setHydrator(new ClassMethods());
        $hydrator = $this->getHydrator();
        $hydrator->addStrategy('breed', new BreedReviewStrategy($this->om));
        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'breed',
            'options' => [
                'object_manager' => $this->om,
                'target_class'   => 'IodogsDoctrine\Entity\Breed',
                'property'       => 'rusTitle',
                'label'       => 'Порода',
                'is_method'      => true,
                'empty_option'   => 'Выберите породу',
                'find_method'    => [
                    'name'   => 'findBy',
                    'params' => [
                        'criteria' => [],
                        'orderBy'  => ['rusTitle' => 'ASC'],
                    ],
                ],
            ],
        ]);

        $this->add([
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'product',
            'attributes' => [
                'class' => 'product-set',
            ],
            'options' => [
                'label' => 'Использованные средства',
                'count' => 1,
                'multiple' => true,
                'should_create_template' => true,
                'allow_add' => true,
                /*'template_placeholder' => '__product__',*/
                'target_element' => new ProductReviewFieldset($objectManager)
            ],
        ]);

        $this->add([
            'name' => 'name',
            'type' => 'Text',
            'options' => [
                'label' => 'Имя',
            ],
            'attributes' => [
                'placeholder' => 'Введите имя',
                'autocomplete' => 'off'
            ],
        ]);

        $this->add([
            'name' => 'email',
            'type' => 'Email',
            'options' => [
                'label' => 'Email',
            ],
            'attributes' => [
                'placeholder' => 'Введите email',
                'autocomplete' => 'off'
            ],
        ]);

        $this->add([
            'name' => 'city_entered',
            'type' => 'Text',
            'options' => [
                'label' => 'Город',
            ],
            'attributes' => [
                'placeholder' => 'Введите город',
                'autocomplete' => 'off'
            ],
        ]);



        $this->add([
            'name' => 'phone',
            'type' => 'Text',
            'options' => [
                'label' => 'Телефон',
            ],
            'attributes' => [
                'placeholder' => 'Введите телефон',
                'autocomplete' => 'off'
            ],
        ]);

        $this->add([
            'name' => 'application',
            'type' => 'Textarea',
            'options' => [
                'label' => 'Отзыв',
            ],
            'attributes' => [
                'placeholder' => 'Текст отзыва',
                'autocomplete' => 'off'
            ],
        ]);



        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'value' => 'Сохранить',
                'id' => 'submitbutton',
                'class' => 'btn-success'
            ],
        ]);






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