<?php
namespace IodogsProduct\Strategy;

use Zend\Hydrator\Strategy\StrategyInterface;
use Doctrine\ORM\EntityManager;

class ProductFieldsetStrategy implements StrategyInterface
{ 
    public function extract($value)
    {
        //print_r($value);
        //die("!extract!!!");
        return $value;
        
    }
    public function hydrate($value){
        print_r($value);
        die("HYDRA!!!");
    }
}