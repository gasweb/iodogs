<?php
namespace IodogsBreed\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use IodogsProduct\Form\ProductFieldset;
use IodogsProduct\Strategy\ProductCollectionStrategy;
use IodogsDoctrine\Entity\Breed;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

class BreedProductForm extends Form implements ObjectManagerAwareInterface
{
    public function __construct(ObjectManager $objectManager)
    {

        $this->setObjectManager($objectManager);
        //$this->setHydrator(new \Zend\Hydrator\ClassMethods());
        $this->setHydrator(new DoctrineObject($objectManager, '\IodogsDoctrine\Entity\Breed'))->setObject(new Breed());
        $hydrator = $this->getHydrator();

        $hydrator->addStrategy('product', new ProductCollectionStrategy());

        parent::__construct('breed-form');

        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Сохранить',
                'id' => 'submitbutton',
                'class' => 'btn-success'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'product',
            'attributes' => array(
                'class' => 'product-set',
            ),
            'options' => array(
                'label' => 'Средства для породы',
                'count' => 1,
                'multiple' => true,
                'should_create_template' => true,
                'allow_add' => true,
                /*'template_placeholder' => '__product__',*/
                'target_element' => new ProductFieldSet($objectManager)
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