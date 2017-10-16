<?php
 namespace IodogsProduct\Service\Abstraction;

 interface ProductServiceInterface
 {
     /**
      * Должен возращать набор записей в виде массива      
      *
      * @return array
      */
     public function findAllProducts();

     /**
      * Должен возвращать один продукт
      *
      * @param  int $id Идентификатор продукта, который должен вернуть метод      
      */
     public function findProductById($id);
 }