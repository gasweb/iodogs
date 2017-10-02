<?php

namespace IodogsBreed\Form\InputFilter;

use Zend\InputFilter\InputFilter;

class BreedFormFilter extends InputFilter {
    public function __construct() {

        $this->add(array(
            'name' => 'eng_title',
            'required' => true
        ));

        $this->add(array(
            'name' => 'rus_title',
            'required' => true
        ));

        $this->add(array(
            'name' => 'info_block',
            'required' => false
        ));



        $this->add(array(
                    'name' => 'slug',
                    'required' => true
                ));


    }
}