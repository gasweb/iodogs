<?php
namespace IodogsCatalog\Strategy;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;
use Doctrine\ORM\EntityManager;

class ParentCategoryStrategy implements StrategyInterface
{
    private $em;

    public function __construct(EntityManager $em){
        $this->em = $em;
    }

    public function extract($value)
    {     
        if($value instanceof IodogsDoctrine\Entity\Category)
        {
        return $value->getId();
        }
        return $value;
    }
    public function hydrate($value)
    {
        if(!$value) return 0;
        else return $this->em->find('IodogsDoctrine\Entity\Category', $value)->getId();
    }
}