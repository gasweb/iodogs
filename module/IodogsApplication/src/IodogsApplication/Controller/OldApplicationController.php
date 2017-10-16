<?php
namespace IodogsApplication\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel,
    IodogsProduct\Service\ProductService,
    IodogsBreed\Service\BreedService,
    IodogsCatalog\Service\CatalogService;

/**
 * Default action for module
 * Get ContentEntity by page slug and return array for view
 */

class OldApplicationController extends AbstractActionController
{
    /** @var \Interop\Container\ContainerInterface $container */
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function productAction()
    {
        $productId = (int) $this->params()->fromRoute('id', 0);
        $ProductService = $this->container->get(ProductService::class);
        $Product = $ProductService->getProductById($productId);
        if($ProductService->checkInstance($Product))
        {
            $this->redirect()->toRoute('app/product', array('slug' => $Product->getSlug()))->setStatusCode(301);
        }
        else {
            $this->getResponse()->setStatusCode(404);
            return;
        }
    }

    public function breedAction()
    {
        $breedId = (int) $this->params()->fromRoute('id', 0);
        $BreedService = $this->container->get(BreedService::class);
        $Breed = $BreedService->getBreedById($breedId);
        if($BreedService->checkInstance($Breed))
        {
            $this->redirect()->toRoute('app/breed/breed-slug', array('slug' => $Breed->getSlug()))->setStatusCode(301);
        }
        else {
            $this->getResponse()->setStatusCode(404);
            return;
        }
    }

    public function categoryAction()
    {
        $categoryId = (int) $this->params()->fromRoute('id', 0);
        $CategoryService = $this->container->get(CatalogService::class);
        $Category = $CategoryService->getCategoryById($categoryId);
        if($CategoryService->checkInstance($Category))
        {
            $this->redirect()->toRoute('app/catalog/category-slug', array('slug' => $Category->getSlug()))->setStatusCode(301);
        }
        else {
            $this->getResponse()->setStatusCode(404);
            return;
        }
    }




}