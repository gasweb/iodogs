<?php
namespace IodogsBreed\Strategy;

use DoctrineModule\Stdlib\Hydrator\Strategy\AbstractCollectionStrategy;

class BreedProductCollectionStrategy extends AbstractCollectionStrategy
{

    /**
     * @param mixed $value
     * @return object
     */

    public function hydrate($value)
    {
        $Product = $this->getObject();
        $productBreeds = $Product->getBreed();
        foreach ($productBreeds as $productBreed)
        {
            $Product->removeBreed($productBreed);
            $productBreed->removeProduct($Product);
        }

        foreach ($value as $item) {
            $Product->addBreed($item);
        }
        //return $Product;
    }

}