<?php

namespace IodogsApplication\Form;

use Zend\InputFilter\InputFilter;

class ContentFilter extends InputFilter {
    public function __construct() {
        $this->add(array(
            'name' => 'parent',
            'required' => false,
            /*'filters' => array(
                array('name' => 'Int'),
            ),*/
        ));
         $this->add(array(
            'name' => 'href',
            'required' => true,
            /*'filters' => array(
                array('name' => 'Int'),
            ),*/
        ));

       /* $this->add(array(
            'name' => 'comment',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 100,
                    ),
                ),
            ),
        ));*/
    }
}