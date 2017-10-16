<?php
namespace IodogsBreed\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use IodogsBreed\Form\BreedListForm;

class BreedController extends AbstractActionController
{
    /**
     * @var \IodogsProduct\Service\ProductService  
     */
    private $productService;

    /**
     * @var \IodogsBreed\Service\BreedService
     */
    private $breedService;

    /**
     * @var \IodogsReview\Service\ReviewService
     */
    private $reviewService;

    /**
     * BreedController constructor.
     * @param $ProductService
     * @param $BreedService
     * @param $ReviewService
     */
    public function __construct($ProductService, $BreedService, $ReviewService)
    {
        $this->productService = $ProductService;
        $this->breedService = $BreedService;
        $this->reviewService = $ReviewService;
    }

    public function allBreedsAction()
    {
       /*
        * Вызывает сервис для работы с породой 
        * собирает массив пород методом getBreeds()
        * делает массив для view методом getViewInfoByArray()
        * @param Array - breeds
        * @param Array - breedViewInfo
        * @return Array - breed*/

        
        $breeds = $this->breedService->getBreeds();
        $breedViewInfo = $this->breedService->getViewInfoByArray($breeds);
        
        return (array("breed" => $breedViewInfo));        
    }  

    public function currentBreedAction()
          {
          	$breedId = (int) $this->params()->fromRoute('id', 0);
              
          	if($breedId>0){
                
                $Breed = $this->breedService->getBreedById($breedId);
                $breedProducts = $Breed->getProduct();

                $productViewArray = $this->productService->getViewArrayByCollection($breedProducts);
                $breedViewArray = $this->breedService->getViewArray($Breed);

                $breedReviews = $this->reviewService->getReviewByBreedId($breedId);
                $breedReviewViewArray = $this->reviewService->getViewByArray($breedReviews);

        		return (array(
                    "products" => $productViewArray,
        			"reviews" => $breedReviewViewArray,
        			"breed" =>$breedViewArray,
//        			"breed_form" =>$BreedListForm,
        			)
        		); 

          	}
          }   
    
    public function breedSlugAction()
          {
          	$breedSlug = $this->params()->fromRoute('slug', null);
              
          	if($breedSlug){
                
                $Breed = $this->breedService->getBreedBySlug($breedSlug);
                if($this->breedService->checkInstance($Breed)){


//                $breedProducts = $this->breedService->getBreedProducts($Breed);
                $breedProducts = $Breed->getProduct();

                $productViewArray = $this->productService->getViewArrayByCollection($breedProducts);
                $breedViewArray = $this->breedService->getViewArray($Breed);

                $breedReviews = $this->reviewService->getReviewByBreedId($Breed->getId());
                $breedReviewViewArray = $this->reviewService->getViewByArray($breedReviews);

        		return (array(
                    "products" => $productViewArray,
        			"reviews" => $breedReviewViewArray,
        			"breed" =>$breedViewArray,
//        			"breed_form" =>$BreedListForm,
        			)
        		); 

          	}
          	}
              $this->getResponse()->setStatusCode(404);
              return;
          }
}
