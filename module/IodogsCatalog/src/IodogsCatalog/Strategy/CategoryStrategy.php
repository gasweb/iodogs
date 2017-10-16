<?php
namespace IodogsCatalog\Strategy;

use Zend\Hydrator\Strategy\StrategyInterface;
use Doctrine\ORM\EntityManager;

class CategoryStrategy implements StrategyInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function extract($value)
    {     
        if($value instanceof \IodogsDoctrine\Entity\Category)
        {
            return $value->getId();
        }
        return $value;
    }
    public function hydrate($value)
    {
        return $this->em->find('IodogsDoctrine\Entity\Category', $value);
    }
}