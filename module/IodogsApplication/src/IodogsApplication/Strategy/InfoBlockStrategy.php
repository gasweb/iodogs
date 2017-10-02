<?php
namespace IodogsApplication\Strategy;

use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;
use Doctrine\ORM\EntityManager;

class InfoBlockStrategy implements StrategyInterface
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function extract($value)
    {
        if($value instanceof IodogsDoctrine\Entity\InfoBlock)
        {
            return $value->getId();
        }
        return $value;
    }

    public function hydrate($value)
    {

        return $this->em->find('IodogsDoctrine\Entity\InfoBlock', $value);
    }
}