<?php
namespace IodogsProduct\Form;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Fieldset;
use IodogsProduct\Strategy\ProductCollectionStrategy;
use \DoctrineModule\Stdlib\Hydrator\DoctrineObject;

class ProductReviewFieldset extends Fieldset implements ObjectManagerAwareInterface
{
    protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {
        $this->setObjectManager($objectManager);
        parent::__construct('product-field-set');

        $this->add(array(
            'type' => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
            'name' => 'id',
            'options' => array(
                'object_manager' => $this->objectManager,
                'target_class'   => 'IodogsDoctrine\Entity\Product',
                'property'       => 'rusTitle',
                'label'       => 'Шампуни',
                'is_method'      => true,
                'empty_option'   => 'Выберите продукт',
                'find_method'    => array(
                    'name'   => 'findBy',
                    'params' => array(
                        'criteria' => array('category' => 1),
                        'orderBy'  => array('id' => 'ASC', 'category' => 'ASC'),
                    ),
                ),
            ),
            'attributes' => array(
                'class' => 'form-breed-product-checkbox',
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