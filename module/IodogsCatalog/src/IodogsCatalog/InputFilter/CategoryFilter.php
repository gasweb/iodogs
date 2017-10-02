<?php

namespace IodogsCatalog\InputFilter;

use Zend\InputFilter\InputFilter;

class CategoryFilter extends InputFilter {
    public function __construct() {
        $this->add(array(
            'name' => 'parent',
            'required' => false,
            /*'filters' => array(
                array('name' => 'Int'),
            ),*/
        ));
         $this->add(array(
            'name' => 'content',
            'required' => false,
            /*'filters' => array(
                array('name' => 'Int'),
            ),*/
        ));
    }
}