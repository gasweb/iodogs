<?php

namespace IodogsBreed\Form\InputFilter;

use Zend\InputFilter\InputFilter;

class BreedProductInputFilter extends InputFilter {
    public function __construct() {

        $this->add(array(
            'name' => 'product',
            'required' => false
        ));
    }
}