<?php
namespace IodogsCatalog\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

class CatalogController extends AbstractActionController
{

    /**
    * @var \IodogsProduct\Service\ProductService
    */
    private $productService;

    /**
    * @var \IodogsCatalog\Service\CatalogService
    */
    private $catalogService;

    /**
    * @var \IodogsCatalog\Service\LineService
    */
    private $lineService;

    
    public function __construct($CatalogService, $ProductService, $lineService)
    {
        
        $this->productService = $ProductService;
        $this->catalogService = $CatalogService;
        $this->lineService = $lineService;
    }

    public function indexAction()
    {
        $categoryId = (int) $this->params()->fromRoute('id', 0);
        $Category = $this->catalogService->getCategoryById($categoryId);
        $Products = $this->productService->getProductsByCategory($categoryId);

        /*$ProductService = $this->getServiceLocator()
                    ->get('ProductService');
        $Products = $ProductService->getProductsByCategory($categoryId); */

       
        if($Products){
            foreach($Products AS $Product){
                $productsViewArray[] = $this->productService->getProductViewArray($Product);
            }
        }
        $viewModel = new ViewModel(array(
            'category' => $Category,
            'products' => $productsViewArray
        ));
        $viewModel->setTemplate('iodogs-catalog/catalog/slug.phtml');
        return $viewModel;
    }


    public function categoryAction()
    {

        $categories = $this->catalogService->getCategoriesArray();

        return [
            "categories" => $categories
        ];
    }

    public function slugAction(){
        $categorySlug = $this->params()->fromRoute('slug', null);
        $Category = $this->catalogService->getCategoryBySlug($categorySlug);
        if($Category)
        {
            $products = $this->productService->getProductsByCategoryId($Category->getId());

            if ($products) {
                foreach ($products AS $Product) {
                    $productsViewArray[] = $this->productService->getViewArray($Product);
                }
            }

            $infoBlockViewArray = $this->catalogService->getViewArray($Category);
            return (array("products" => $productsViewArray, "category" => $Category, 'view' => $infoBlockViewArray));
        }
        else
        {
            $this->getResponse()->setStatusCode(404);
            return;
        }
    }
}
