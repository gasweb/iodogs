<?php
namespace IodogsCatalog\Form;

    use IodogsApplication\Strategy\InfoBlockStrategy;
    use Doctrine\Common\Persistence\ObjectManager;
    use Zend\Form\Form;

        class LineForm extends Form 
        {
            public function __construct(ObjectManager $objectManager)
            {               
                parent::__construct('line-form');
                $this->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                $hydrator = $this->getHydrator();
                $hydrator->addStrategy('info_block', new InfoBlockStrategy($objectManager));

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
                        'label' => 'Название линии',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Введите название линии',
                        'autocomplete' => 'off'
                    ),
                ));

                $this->add(array(
                    'name' => 'slug',
                    'type' => 'Text',
                    'options' => array(
                        'label' => 'Slug',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Alias для линии',
                        'autocomplete' => 'off'
                    ),
                ));

                $this->add(array(
                    'name' => 'img_path',
                    'type' => 'Text',
                    'options' => array(
                        'label' => 'Полный путь к изображению',
                    ),
                    'attributes' => array(
                        'placeholder' => 'http://...',
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
}