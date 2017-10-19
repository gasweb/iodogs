<?php
namespace IodogsFiles\Form\Upload;

use Zend\Filter\File\RenameUpload;
use Zend\Form\Element\File;
use Zend\Form\Element\Submit;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Validator\File\Extension;
use Zend\Validator\File\FilesSize;
use Zend\Validator\File\ImageSize;
use Zend\Validator\File\IsImage;
use Zend\Validator\File\Upload;
use Zend\Validator\File\UploadFile;

class ImageUploadForm extends Form implements InputFilterProviderInterface
{
    protected $files;

    public function __construct($files = null)
    {
        parent::__construct('upload-image-form');
        $this->files = $files;
        $this->init();
//        $InputFilter = new InputFilter();
//        $InputFilter->setData($this->getInputFilterSpecification());
//        $this->setInputFilter($InputFilter);
    }

    public function init()
    {
        $this->add(
            [
                'type' => File::class,
                'name' => 'image_file',
                'attributes' => [
                    'title' => 'Выберите файлы для загрузки',
                    'id' => 'image-file',
                    'class' => 'btn btn-default',
                    'multiple' => 'true'
                ],
            ]
        );
        $this->add(
            [
                'type' => Submit::class,
                'name' => 'submit',
                'attributes' => [
                    'value' => 'Загрузить',
                    'id' => 'submitbutton',
                    'class' => 'btn btn-success'
                ],
            ]
        );
    }

    public function getInputFilterSpecification()
    {
        return [
            'image_file' => [
                'required' => false,
                'validators' => [
                    [
                        'name' => FilesSize::class,
                        'options' => [
                            'min' => '10kB',
                            'max' => '3MB'
                        ],
                    ],
                    [
                        'name' => ImageSize::class,
                        'options' => [
                            'minWidth' => 300,
                            'minHeight' => 300,
                            'maxWidth' => 2048,
                            'maxHeight' => 2048,
                        ],
                    ],
                    [
                        'name' => IsImage::class
                    ],
                    [
                        'name' => Extension::class,
                        'options' => [
                            'extension' => ['jpg', 'png'],
                        ],
                    ],
                    [
                        'name' => UploadFile::class,
                    ]
                ],
                'filters' => [
                    [
                        'name' => RenameUpload::class,
                        'options' => [
                            'target'    => './data/tmp',
                            'randomize' => true,
                            'overwrite' => true,
                            'use_upload_extension' => true,
                        ]
                    ]
                ]
            ],
        ];
    }

}