<?php
namespace IodogsFiles\Form;

use Zend\InputFilter;
use Zend\Form\Element;
use Zend\Form\Form;

class ImageUploadForm extends Form
{
    public function __construct($name = null, $options = array())
    {
        parent::__construct($name, $options);
        $this->addElements();
        $this->addInputFilter();
    }

    public function addElements()
    {
        // File Input
        /*$file = new Element\File('image-file');
        $file->setAttribute('id', 'image-file')        
             ->setAttribute('title', 'Выберите файлы для загрузки')        
             ->setAttribute('multiple', true);
        $this->add($file);*/

        $this->add(array(
                    'name' => 'image-file',
                    'type' => 'File',
                    'attributes' => array(
                        'title' => 'Выберите файлы для загрузки',
                        'id' => 'image-file',
                        'class' => 'btn btn-default',
                        'multiple' => 'true'
                    ),
                ));

        $this->add(array(
                    'name' => 'image-file-single',
                    'type' => 'File',
                    'attributes' => array(
                        'title' => 'Выберите файл для загрузки',
                        'id' => 'image-file',
                        'class' => 'btn btn-default'
                    ),
                ));

        
        $this->add(array(
                    'name' => 'submit',
                    'type' => 'Submit',
                    'attributes' => array(
                        'value' => 'Загрузить',
                        'id' => 'submitbutton',
                        'class' => 'btn btn-success'
                    ),
                ));
    }

    public function addInputFilter()
    {
        $inputFilter = new InputFilter\InputFilter();

        // File Input
        $fileInput = new InputFilter\FileInput('image-file');
        $fileInput->setRequired(true);

        // You only need to define validators and filters
        // as if only one file was being uploaded. All files
        // will be run through the same validators and filters
        // automatically.
        $fileInput->getValidatorChain()
            ->attachByName('filesize',      array('max' => 3204800))
            //->attachByName('filemimetype',  array('mimeType' => 'image/png,image/x-png'))
            ->attachByName('fileimagesize', array('maxWidth' => 1024, 'maxHeight' => 1024));

        // All files will be renamed, i.e.:
        //   ./data/tmpuploads/avatar_4b3403665fea6.png,
        //   ./data/tmpuploads/avatar_5c45147660fb7.png
        $fileInput->getFilterChain()->attachByName(
            'filerenameupload',
            array(
                'target'    => './data/tmpuploads/',
                'randomize' => true,
                'overwrite' => true,
            )
        );
        $inputFilter->add($fileInput);

        $this->setInputFilter($inputFilter);
    }
}