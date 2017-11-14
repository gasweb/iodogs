<?php
namespace IodogsCatalog\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class SolutionController extends AbstractActionController
{
    /**
     * @var \IodogsCatalog\Service\SolutionService
     */
    private $solutionService;

    /**
     * @var \IodogsProduct\Service\ProductService
     */
    private $ProductService;

    public function __construct($ProductService, $SolutionService)
    {

        $this->productService = $ProductService;
        $this->solutionService = $SolutionService;
    }

    public function slugAction()
    {
        $slug =  $this->params()->fromRoute('slug', 0);
        $Solution = $this->solutionService->getSolutionBySlug($slug);
        if($this->solutionService->checkInstance($Solution))
        {
            $viewArray = $this->solutionService->getViewArray($Solution);

            $Products = $Solution->getProduct();
            if($Products){
                foreach($Products AS $Product){
                    $productsViewArray[] = $this->productService->getViewArray($Product);
                }
            }
            return (array("products" => $productsViewArray, "solution" => $viewArray));
        }
        $this->getResponse()->setStatusCode(404);
        return;

    }

    public function listAction()
    {
        $solutions = $this->solutionService->getSolutionArray();
        return (array("solutions" => $solutions));
    }
}
