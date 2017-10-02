<?php
namespace IodogsProduct\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ProductHelper extends AbstractHelper{

    public function showPreview($product)
    {
       // $this->partial()->setObjectKey('product');
        $this->partialLoop()->setObjectKey('product');
        echo $this->partialLoop('partial/product/card.phtml', $products);
    }

    public function showPreviewByArray($productArray){
        if(is_array($productArray)){
            foreach ($productArray AS $product){
                $this->showPreview($product);
            }
        }
    }

}