<?php
namespace IodogsApplication\Navigation\Factory;

use Zend\Navigation\Service\DefaultNavigationFactory;

class ApplicationNavigationFactory extends DefaultNavigationFactory
{
    protected function getName()
    {
        return 'application-nav';
    }
}