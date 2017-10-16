<?php
namespace IodogsProduct\Form;

    use DoctrineModule\Persistence\ObjectManagerAwareInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use Zend\Form\Fieldset;
    use IodogsProduct\Strategy\ProductCollectionStrategy;    
    use \DoctrineModule\Stdlib\Hydrator\DoctrineObject;

        class ProductFieldset extends Fieldset implements ObjectManagerAwareInterface
        {
            protected $objectManager;
            public function __construct(ObjectManager $objectManager)
            {
                $this->setObjectManager($objectManager);                            
                parent::__construct('product-field-set');
                //$this->setHydrator(new \Zend\Hydrator\ClassMethods());
                $this->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($objectManager, "\IodogsDoctrine\Entity\Product"))->setObject(new \IodogsDoctrine\Entity\Product());
                $hydrator = $this->getHydrator();                 

                
                $this->add(array(
                    'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                    'name' => 'id',
                    'options' => array(
                        'object_manager' => $objectManager,
                        'target_class'   => 'IodogsDoctrine\Entity\Product',
                        'property'       => 'engTitle',
                        //'label'       => 'Категория',
                        'is_method'      => true,
                        'empty_option'   => 'Выберите продукт',
                        'find_method'    => array(
                            'name'   => 'findBy',
                            'params' => array(
                                'criteria' => array(),
                                'orderBy'  => array('engTitle' => 'ASC'),
                            ),
                        ),
                    ),
                    'attributes' => array(
                        'class' => 'form-breed-product-select',
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