<?php
namespace IodogsCatalog\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class LineController extends AbstractActionController
{
    /**
     * @var \IodogsCatalog\Service\LineService
     */
    private $lineService;

    /**
     * @var \IodogsProduct\Service\ProductService
     */
    private $ProductService;

    public function __construct($ProductService, $LineService)
    {
        
        $this->productService = $ProductService;
        $this->lineService = $LineService;
    }

    public function indexAction()
    {
        $slug =  $this->params()->fromRoute('slug', 0);
        $Line = $this->lineService->getLineBySlug($slug);
        if($this->lineService->checkInstance($Line))
        {
            $viewArray = $this->lineService->getViewArray($Line);

            $Products = $this->productService->getProductsByLine($Line->getId());
            if($Products){
                foreach($Products AS $Product){
                    $productsViewArray[] = $this->productService->getViewArray($Product);
                }
            }
            return (array("products" => $productsViewArray, "line" => $viewArray));
        }
        $this->getResponse()->setStatusCode(404);
        return;

    }

    public function lineListAction()
    {
        $lines = $this->lineService->getLinesArray();
        return (array("lines" => $lines));
    }
}
