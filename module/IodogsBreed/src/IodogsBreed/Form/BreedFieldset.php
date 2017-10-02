<?php
namespace IsleAdmin\Form;

    use DoctrineModule\Persistence\ObjectManagerAwareInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use Zend\Form\Fieldset;

        class BreedFieldset extends Fieldset implements ObjectManagerAwareInterface
        {
            protected $objectManager;
            public function __construct(ObjectManager $objectManager)
            {
                $this->setObjectManager($objectManager);                            
                parent::__construct('product-field-set');                               
                $this->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($objectManager, "\Iodogs\Entity\Breed"))->setObject(new \Iodogs\Entity\Breed());                
                $hydrator = $this->getHydrator();                 

                
                $this->add(array(
                    'type' => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
                    'name' => 'id',
                    'options' => array(
                        'object_manager' => $objectManager,
                        'target_class'   => 'Iodogs\Entity\Breed',
                        'property'       => 'rusTitle',                        
                        'is_method'      => true,                        
                        'find_method'    => array(
                            'name'   => 'findBy',
                            'params' => array(
                                'criteria' => array(),
                                'orderBy'  => array('rusTitle' => 'ASC'),
                            ),
                        ),
                    ),
                    'attributes' => array(
                        'class' => 'form-product-breed-checkboxes',
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