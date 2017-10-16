<?php
namespace IodogsApplication\Form;

    use DoctrineModule\Persistence\ObjectManagerAwareInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use Zend\Form\Form;
    use IodogsApplication\Strategy\DateUpdateStrategy;

        class ContentForm extends Form implements ObjectManagerAwareInterface
        {
            protected $objectManager;
            const TEXT_AREA_ROWS = 10;
            public function __construct(ObjectManager $objectManager)
            {
                $this->setObjectManager($objectManager);
                $this->setHydrator(new \Zend\Hydrator\ClassMethods);
                $hydrator = $this->getHydrator();
                $hydrator->addStrategy('dateUpdate', new DateUpdateStrategy($objectManager));
                parent::__construct('productForm');

                $this->add(array(
                    'name' => 'href',
                    'type' => 'Text',
                    'options' => array(
                        'property' => 'href',
                        'label' => 'Название ссылки',
                    ),
                    'attributes' => array(
                        'placeholder' => 'напр. index',
                        'autocomplete' => 'off'
                    ),
                ));

                $this->add(array(
                    'name' => 'header',
                    'type' => 'Text',
                    'options' => array(
                        'label' => 'Заголовок материала',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Введите название',
                        'autocomplete' => 'off'
                    ),
                ));

                $this->add(array(
                    'name' => 'description',
                    'type' => 'Textarea',
                    'options' => array(
                        'property' => 'description',
                        'label' => 'Описание страницы для preview',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Описание',
                        'rows' => self::TEXT_AREA_ROWS
                    ),
                ));

                $this->add(array(
                    'name' => 'content',
                    'type' => 'Textarea',
                    'options' => array(
                        'property' => 'content',
                        'label' => 'Основное содержимое',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Основное содержимое',
                        'rows' => 25
                    ),
                ));

                $this->add(array(
                    'name' => 'title',
                    'type' => 'Text',
                    'options' => array(
                        'property' => 'title',
                        'label' => 'Заголовок страницы материала',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Введите заголовок',
                        'autocomplete' => 'off'
                    ),
                ));

                 $this->add(array(
                    'name' => 'snippet',
                    'type' => 'Textarea',
                    'options' => array(
                        'property' => 'snippet',
                        'label' => 'Текст для мета тега description',
                    ),
                    'attributes' => array(
                        'placeholder' => 'Введите для мета тега description',
                        'rows' => 5
                    ),
                ));

                $this->add(array(
                    'name' => 'keywords',
                    'type' => 'Textarea',
                    'options' => array(
                        'property' => 'keywords',
                        'label' => 'Ключевые слова',
                    ),
                    'attributes' => array(

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