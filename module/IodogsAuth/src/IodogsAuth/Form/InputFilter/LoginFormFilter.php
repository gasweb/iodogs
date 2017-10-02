<?php

namespace IodogsBreed\Form\InputFilter;

use Zend\InputFilter\InputFilter;

class BreedFormFilter extends InputFilter {
    public function __construct() {

        $this->add(array(
            'name' => 'captcha',
            'required' => true
        ));
        


    }
}