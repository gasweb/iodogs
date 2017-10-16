<?php
namespace IodogsCatalog\Strategy;

use Zend\Hydrator\Strategy\StrategyInterface;
use Doctrine\ORM\EntityManager;

class LineStrategy implements StrategyInterface
{
    private $em;
    public function __construct(EntityManager $em){
        $this->em = $em;
    }

    public function extract($value)
    {             
        if($value instanceof \IodogsDoctrine\Entity\Line)
        {
        return $value->getId();
        }
        return $value;
    }
    public function hydrate($value)
    {
        return $value;
        return $this->em->find('IodogsDoctrine\Entity\Line', $value);
    }
}