<?php
namespace IodogsCatalog\InputFilter;

use Zend\InputFilter\InputFilter;

class SolutionFormInputFilter extends InputFilter
{
    public function __construct()
    {
        $this->add(array(
            'name' => 'info_block',
            'required' => false,
        ));
    }
}