<?php
namespace IodogsApplication\Form\InputFilter;

use Zend\InputFilter\InputFilter;

class ContactFormInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'csrf',
            'required' => true,
        ));
        $this->add(array(
            'name' => 'name',
            'required' => true,
        ));

    }
}