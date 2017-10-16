<?php
namespace IodogsApplication\Strategy;

use Zend\Hydrator\Strategy\StrategyInterface;
use Doctrine\ORM\EntityManager;

class DateUpdateStrategy implements StrategyInterface
{
    private $em;
    public function __construct(EntityManager $em){
        $this->em = $em;
    }

    public function extract($value)
    {
        return $value;
    }
    public function hydrate($value)
    {
        return new \DateTime("now");
    }
}