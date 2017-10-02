<?php

namespace IodogsFiles\InputFilter;

use Zend\InputFilter\InputFilter;

class ImageEditFilter extends InputFilter {
    public function __construct() {
        $this->add(array(
            'name' => 'description',
            'required' => false            
        ));
         $this->add(array(
            'name' => 'sort_order',
            'required' => false
        ));
         $this->add(array(
            'name' => 'is_delete',
            'required' => false
        ));
    }
}