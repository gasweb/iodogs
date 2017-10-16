<?php
namespace IodogsCatalog\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\Strategy\AllowRemoveByValue;
use IodogsCatalog\Strategy\SolutionProductCollectionStrategy;
use IodogsDoctrine\Entity\Product;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Hydrator\ClassMethods;

class SolutionProductForm extends Form implements ObjectManagerAwareInterface
{
    public function __construct(ObjectManager $objectManager)
    {

        $this->setObjectManager($objectManager);
        $this->setHydrator(new DoctrineObject($objectManager, '\IodogsDoctrine\Entity\Solution'))->setObject(new \IodogsDoctrine\Entity\Solution());
        $hydrator = $this->getHydrator();
        $hydrator->addStrategy('product', new SolutionProductCollectionStrategy());
        parent::__construct('solution-product-form');

        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
            'name' => 'product',
            'options' => array(
                'object_manager' => $objectManager,
                'target_class'   => 'IodogsDoctrine\Entity\Product',
                'property'       => 'engTitle',
                'is_method'      => true,
                'find_method'    => array(
                    'name'   => 'findBy',
                    'params' => array(
                        'criteria' => array(),
                        'orderBy'  => array('sortOrder' => 'ASC'),
                    ),
                ),
            ),
            'attributes' => array(
                'class' => 'form-product-breed-checkboxes',
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