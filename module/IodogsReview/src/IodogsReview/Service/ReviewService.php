<?php
namespace IodogsReview\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use IodogsApplication\Interfaces\IodogsServiceInterface;

class ReviewService implements IodogsServiceInterface
{
//    protected $services;
    /**
     * @var \Doctrine\ORM\EntityManager
     */
	private $objectManager;

    /**
     * @var \IodogsBreed\Service\BreedService
     */
    private $breedService;

    /**
     * @var \IodogsProduct\Service\ProductService*/
    private $productService;


    /**
     * ReviewService constructor.
     * @param $objectManager
     * @param $breedService
     * @param $productService
     */
    public function __construct($objectManager, $breedService, $productService)
    {
        $this->om = $objectManager;
        $this->breedService = $breedService;
        $this->productService = $productService;
    }

    /**
     * @param $breedId
     * @return mixed
     */
    public function getReviewByBreedId($breedId)
    {
        $reviews = array();
        $Breed = $this->breedService->getBreedById($breedId);
        $reviewBreed =  $this->om->getRepository('IodogsDoctrine\Entity\Review')->findBy(array('breed' => $Breed, 'active' => 1));
        if(is_array($reviewBreed))
        {
            foreach ($reviewBreed AS $ReviewBreed)
            {
                $reviews[] = $ReviewBreed;
            }
        }
        return $reviews;
    }

    public function getBreedByReview($Review)
    {
        $Review = $this->om->getRepository('IodogsDoctrine\Entity\Review')->findOneBy(array(
            'id' => $Review->getId(),
            'active' => 1
        ));
        $Breed = $Review->getBreed();
        return $Breed;
    }

    public function getReviewByProductId($productId)
    {
        $Product = $this->productService->getProductById($productId);
        return $Product->getReview();
    }

    public function getViewByArray($reviews)
    {
        foreach ($reviews as $review) {
            $reviewArray[] = $this->getViewArray($review);
        }
        return $reviewArray;
    }

    public function getViewArray($Review)
    {
        $viewArray = array();
        if($this->checkInstance($Review)){
            $Breed = $this->getBreedByReview($Review);
            $breedViewArray = $this->breedService->getViewArray($Breed);
            $viewArray = Array(
                "id" => $Review->getId(),
                "name" => $Review->getName(),
                "review" => $Review->getReview(),
                "city" => $Review->getCityEntered(),
                "products" => $this->productService->getViewArrayByCollection($Review->getProduct()),
                "breed" => $breedViewArray
            );
        }
        else {
            //print_r($Review);
            die;
        }
        return $viewArray;

    }

    public function checkInstance($Review)
    {
        if($Review instanceof \IodogsDoctrine\Entity\Review)
            return true;
        return false;
    }
}