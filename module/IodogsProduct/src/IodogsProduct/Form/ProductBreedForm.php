<?php
namespace IodogsProduct\Form;

    use DoctrineModule\Persistence\ObjectManagerAwareInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use IodogsBreed\Strategy\BreedProductCollectionStrategy;
    use IodogsDoctrine\Entity\Product;
    use Zend\Form\Form;
    use DoctrineModule\Stdlib\Hydrator\DoctrineObject;

        class ProductBreedForm extends Form implements ObjectManagerAwareInterface
        {                        
            public function __construct(ObjectManager $objectManager)
            {               
               
                $this->setObjectManager($objectManager);
                $this->setHydrator(new DoctrineObject($objectManager, "\IodogsDoctrine\Entity\Product"))->setObject(new Product());
//                $this->setHydrator(new \Zend\Hydrator\ClassMethods());
                $hydrator = $this->getHydrator(); 
                $hydrator->addStrategy('breed', new BreedProductCollectionStrategy());
                parent::__construct('product-breed-form');                                     
                $this->add(array(
                    'type' => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
                    'name' => 'breed',
                    'options' => array(
                        'object_manager' => $objectManager,
                        'target_class'   => 'IodogsDoctrine\Entity\Breed',
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