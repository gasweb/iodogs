<?php
namespace IodogsBreed\Form;

    use DoctrineModule\Persistence\ObjectManagerAwareInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    //use IodogsBreed\Strategy\BreedCollectionStrategy;     
    use Zend\Form\Form;

        class BreedListForm extends Form implements ObjectManagerAwareInterface
        {                        
            public function __construct(ObjectManager $objectManager)
            {               
               
                $this->setObjectManager($objectManager);
               
                 /*$this->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($objectManager, "\Iodogs\Entity\Breed"))->setObject(new \Iodogs\Entity\Breed());                
               $hydrator = $this->getHydrator(); 
                $hydrator->addStrategy('breed', new \IsleAdmin\Strategy\ProductBreedStrategy($objectManager)); */  
                $this->setHydrator(new \Zend\Hydrator\ClassMethods);
                /*$this->setHydrator(new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($objectManager, "\Iodogs\Entity\Breed"))->setObject(new \Iodogs\Entity\Breed()); */
                $hydrator = $this->getHydrator();  
               /* $hydrator->addStrategy('breed', new \Iodogs\Strategy\BreedStrategy($objectManager));  */        
                parent::__construct('breed-list-form');                                     
                               

                
                $this->add(array(
                    'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                    'name' => 'breed',
                    'options' => array(
                        'object_manager' => $objectManager,
                        'target_class'   => 'IodogsDoctrine\Entity\Breed',
                        'property'       => 'rusTitle',
                        'label'       => 'Выбор по породе',
                        'is_method'      => true,
                        'empty_option'   => 'Специально для породы',
                        'find_method'    => array(
                            'name'   => 'findBy',
                            'params' => array(
                                'criteria' => array(),
                                'orderBy'  => array('rusTitle' => 'ASC'),
                            ),
                        ),
                    ),
                    'attributes' => array(
                        'class' => 'form-control',                        
                    ),
                ));

                $this->add(array(
                    'name' => 'submit',
                    'type' => 'Submit',
                    'attributes' => array(
                        'value' => 'перейти',
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