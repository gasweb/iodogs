<?php
namespace IodogsFiles\Form;

    use DoctrineModule\Persistence\ObjectManagerAwareInterface;
    use Doctrine\Common\Persistence\ObjectManager;
    use Zend\Form\Form;
//    use IodogsApplication\Strategy\DateUpdateStrategy;

class ImageEditForm extends Form implements ObjectManagerAwareInterface
{
    public function __construct(ObjectManager $objectManager)
    {               
               
    $this->setObjectManager($objectManager);
    $this->setHydrator(new \Zend\Hydrator\ClassMethods);
    $hydrator = $this->getHydrator();  
    parent::__construct('image-edit-form');
        $this->add(array(
                'name' => 'sort_order',
                'type' => 'Text',
                'options' => array(
                    'property' => 'sortOrder',
                    'label' => 'Порядок',
                ),
                'attributes' => array(
                    'placeholder' => 'Введите порядок',
                ),
            ));
        $this->add(array(
                'name' => 'description',
                'type' => 'Textarea',
                'options' => array(
                    'property' => 'description',
                    'label' => 'Описание',
                ),
                'attributes' => array(
                    'placeholder' => 'Введите описание',
                ),
            ));
        $this->add(array(
                'name' => 'is_delete',
                'type' => 'Checkbox',
                'options' => array(
                    'property' => 'isDelete',
                    'label' => 'Удалить',
                ),
                'attributes' => array(
                    'placeholder' => 'Введите описание',
                ),
            ));

          $this->add(array(
                    'name' => 'submit',
                    'type' => 'Submit',
                    'attributes' => array(
                        'value' => 'Сохранить',
                        'id' => 'submitbutton',
                        'class' => 'btn btn-success'
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