<?php
namespace IodogsProduct\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use IodogsProduct\Service\ProductService;
use IodogsProduct\Form\ProductForm;

class ProductController extends AbstractActionController
{
    /**
    * @var \IodogsProduct\Service\ProductService
    */
    private $productService;

    /**
     * @var \IodogsReview\Service\ReviewService
     */
    private $reviewService;

    public function __construct($productService, $reviewService)
    {
        $this->productService = $productService;
        $this->reviewService = $reviewService;
    }

 /**
 * Action для генерации карточки товара
 */
    public function indexAction()
    {
        $productSlug =  $this->params()->fromRoute('slug', 0);
        

        $Product = $this->productService->getProductBySlug($productSlug);
        if($this->productService->checkInstance($Product))
        {
            $reviews = $Product->getReview();
            $reviewArray = $this->reviewService->getViewByArray($reviews);
            $productViewArray = $this->productService->getViewArray($Product);
            return (
                [
                    "product" => $productViewArray,
                    "reviews" =>$reviewArray
                ]
            );
        }
        $this->getResponse()->setStatusCode(404);
        return;

    }        
}
