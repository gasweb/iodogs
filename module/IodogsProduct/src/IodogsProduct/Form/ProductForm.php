<?php
namespace IodogsProduct\Form;

    use DoctrineModule\Persistence\ObjectManagerAwareInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use Zend\Form\Form;
    use IodogsApplication\Strategy\DateUpdateStrategy;

        class ProductForm extends Form implements ObjectManagerAwareInterface
        {
            protected $objectManager;
            const TEXT_AREA_ROWS = 15;
            public function __construct(ObjectManager $objectManager)
            {
                $this->setObjectManager($objectManager);
                $this->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                $hydrator = $this->getHydrator();     
                $hydrator->addStrategy('category', new \IodogsCatalog\Strategy\CategoryStrategy($objectManager));          
                $hydrator->addStrategy('line', new \IodogsCatalog\Strategy\LineStrategy($objectManager));          

                parent::__construct('productForm');
                
                $this->add(array(
                    'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                    'name' => 'category',
                    'options' => array(
                        'object_manager' => $objectManager,
                        'target_class'   => 'IodogsDoctrine\Entity\Category',
                        'property'       => 'title',
                        'label'       => 'Категория',
                        'is_method'      => true,
                        'empty_option'   => 'Выберите категорию',
                        'find_method'    => array(
                            'name'   => 'findBy',
                            'params' => array(
                                'criteria' => array(),
                                'orderBy'  => array('title' => 'ASC'),
                            ),
                        ),
                    ),
                ));
                $this->add(array(
                    'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                    'name' => 'line',
                    'options' => array(
                        'object_manager' => $objectManager,
                        'target_class'   => 'IodogsDoctrine\Entity\Line',
                        'property'       => 'title',
                        'label'       => 'Линия',
                        'is_method'      => true,
                        'empty_option'   => 'Выберите линию',
                        'find_method'    => array(
                            'name'   => 'findBy',
                            'params' => array(
                                'criteria' => array(),
                                'orderBy'  => array('title' => 'ASC'),
                            ),
                        ),
                    ),
                ));

                $this->add(array(
                    'name' => 'eng_title',
                    'type' => 'Text',
                    'options' => array(
                        'property' => 'engTitle',
                        'label' => 'Название на англ.',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Введите название',
                        'autocomplete' => 'off'
                    ),
                ));
                  $this->add(array(
                    'name' => 'rus_title',
                    'type' => 'Text',
                    'options' => array(
                        'property' => 'rusTitle',
                        'label' => 'Название на рус.',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Введите название',
                        'autocomplete' => 'off'
                    ),
                ));

                $this->add(array(
                    'name' => 'slug',
                    'type' => 'Text',
                    'options' => array(
                        'label' => 'alias имени в url',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Например shampoo-10',
                        'autocomplete' => 'off'
                    ),
                ));

                  $this->add(array(
                    'name' => 'tag',
                    'type' => 'Text',
                    'options' => array(
                        'property' => 'tag',
                        'label' => 'Теги',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Введите тег',
                        'autocomplete' => 'off'
                    ),
                ));

                  $this->add(array(
                    'name' => 'sort_order',
                    'type' => 'Text',
                    'options' => array(
                        'label' => 'Порядок сортировки',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Введите число',
                        'autocomplete' => 'off'
                    ),
                ));

                 $this->add(array(
                    'name' => 'preview',
                    'type' => 'Textarea',
                    'options' => array(
                        'property' => 'preview',
                        'label' => 'Вступительный текст',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Введите описание',
                        'rows' => self::TEXT_AREA_ROWS
                    ),
                ));
                  $this->add(array(
                    'name' => 'vantage',
                    'type' => 'Textarea',
                    'options' => array(
                        'property' => 'vantage',
                        'label' => 'Блок преимущества для разметки',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Опишите преимущества',
                        'rows' => self::TEXT_AREA_ROWS
                    ),
                ));
                 
                 $this->add(array(
                    'name' => 'card_text',
                    'type' => 'Textarea',
                    'options' => array(
                        'property' => 'cardText',
                        'label' => 'Полное описание',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Введите описание',
                        'rows' => self::TEXT_AREA_ROWS
                    ),
                ));
                  $this->add(array(
                    'name' => 'application',
                    'type' => 'Textarea',
                    'options' => array(
                        'property' => 'application',
                        'label' => 'Применение',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Опишите применение',
                        'rows' => self::TEXT_AREA_ROWS
                    ),
                ));
                 $this->add(array(
                    'name' => 'ingredients',
                    'type' => 'Textarea',
                    'options' => array(
                        'property' => 'ingredients',
                        'label' => 'Ингредиенты',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Опишите ингредиенты',
                        'rows' => self::TEXT_AREA_ROWS
                    ),
                ));
                 $this->add(array(
                    'name' => 'active',
                    'type' => 'Checkbox',
                    'options' => array(
                        'property' => 'active',
                        'label' => 'Показывать на сайте',
                    ),
                    'attributes' => array(                        
                        'rows' => self::TEXT_AREA_ROWS
                    ),
                ));
                   $this->add(array(
                    'name' => 'in_stock',
                    'type' => 'Checkbox',
                    'options' => array(
                        'property' => 'inStock',
                        'label' => 'В наличии',
                    ),
                    'attributes' => array(                        
                        'rows' => self::TEXT_AREA_ROWS
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