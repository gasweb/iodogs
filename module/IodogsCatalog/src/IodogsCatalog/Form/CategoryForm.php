<?php
namespace IodogsCatalog\Form;

    use DoctrineModule\Persistence\ObjectManagerAwareInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use Zend\Form\Form;
    use IodogsApplication\Strategy\InfoBlockStrategy;

        class CategoryForm extends Form implements ObjectManagerAwareInterface
        {
            protected $objectManager;
            const TEXT_AREA_ROWS = 10;
            public function __construct(ObjectManager $objectManager)
            {
                $this->setObjectManager($objectManager);
                $this->setHydrator(new \Zend\Hydrator\ClassMethods);
                $hydrator = $this->getHydrator();
                $hydrator->addStrategy('info_block', new InfoBlockStrategy($objectManager));

                parent::__construct('categoryForm');
                
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
                    'name' => 'title',
                    'type' => 'Text',
                    'options' => array(
                        'property' => 'title',
                        'label' => 'Название категории',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Введите название категории',
                        'autocomplete' => 'off'
                    ),
                ));

                   $this->add(array(
                    'name' => 'slug',
                    'type' => 'Text',
                    'options' => array(
                        /*'property' => 'titleaaa',*/
                        'label' => 'Alias url категории',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Введите название категории',
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