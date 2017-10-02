<?php
namespace IodogsProduct\Strategy;

use DoctrineModule\Stdlib\Hydrator\Strategy\AbstractCollectionStrategy;
//use Doctrine\ORM\EntityManager;

class ProductCollectionStrategy extends AbstractCollectionStrategy
{ 
    const PRODUCT_ENTITY = "\IodogsDoctrine\Entity\Product";
    public function _hydrate($value){
        $breedProducts = $this->getObject()->getProduct();
        foreach ($breedProducts as $product) {
            $this->getObject()->removeProduct($product);
        }          
        if(is_array($value))
        foreach($value AS $product)
        {
            if(is_object($product) && $product instanceof PRODUCT_ENTITY)            
            $this->getObject()->addProduct($product);
        }
    }

    /**
     * Метод удаляет все продукты для текущего объекта Breed Entity после чего наполняет полученными из формы  Product Entity Breed и возвращает объект
     * @param mixed $value
     * @return object
     */

    public function hydrate($value)
    {
        $productValues = array();
        $Breed = $this->getObject();
        $breedProducts = $Breed->getProduct();
        foreach ($breedProducts as $breedProduct) {
            $Breed->removeProduct($breedProduct);
            $breedProduct->removeBreed($Breed);
        }
        foreach ($value as $item) {
            if(!in_array($item->getId(), $productValues))
            $Breed->addProduct($item);
            $productValues[] = $item->getId();
        }
    }

}