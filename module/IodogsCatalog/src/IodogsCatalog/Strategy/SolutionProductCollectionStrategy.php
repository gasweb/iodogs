<?php
namespace IodogsCatalog\Strategy;

use DoctrineModule\Stdlib\Hydrator\Strategy\AbstractCollectionStrategy;

class SolutionProductCollectionStrategy extends AbstractCollectionStrategy
{

    /**
     * @param mixed $value
     * @return object
     */

    public function hydrate($value)
    {
//        die('FUCKER');
        $Solution = $this->getObject();
        $solutionProducts = $Solution->getProduct();
        foreach ($solutionProducts as $solutionProduct)
        {
            $Solution->removeProduct($solutionProduct);
            $solutionProduct->removeSolution($Solution);
        }

        foreach ($value as $item) {
            $Solution->addProduct($item);
        }

    }



}