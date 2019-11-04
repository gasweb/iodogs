<?php
namespace IodogsProduct\Service;

class ProductService
{
	
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $om;

    /**
     * @var \IodogsFiles\Service\ImageService
     */
    private $imageService;

    private $partnerConfig = [];

    /**
     * ProductService constructor.
     * @param $objectManager
     * @param $imageService
     * @param array $partnerConfig
     */
    public function __construct($objectManager, $imageService, array $partnerConfig = [])
    {
        $this->om = $objectManager;
        $this->imageService = $imageService;
        $this->partnerConfig = $partnerConfig;
    }

    public function getProductsByCategoryId($categoryId){
        if($categoryId>0){
            $products = $this->om->
            getRepository('IodogsDoctrine\Entity\Product')->
            findBy(
                array(
                    'category' => $categoryId,
                    'active' => 1),
                array('sortOrder' => 'ASC')
            );
            if(is_array($products))
            return $products;
        }
        return null;
    }

    public function getProductsByBreedId($breedId){
        if($breedId>0){
            $products = $this->om->
            getRepository('IodogsDoctrine\Entity\Product')->
            findBy(
                array('breed' => $breedId)
            );
            if(is_array($products))
            return $products;
        }
        return null;
    }



    public function getProductsByLine($lineId){
            if($lineId>0){                
                $Products = $this->om->
                getRepository('IodogsDoctrine\Entity\Product')->
                findBy(array('line' => $lineId, 'active' => 1),
                    array('sortOrder' => 'ASC'));
                return $Products;
            }
        }


    public function getProductById($productId){
        if($productId>0){
            $Product = $this->om->find('IodogsDoctrine\Entity\Product', $productId);
            return $Product;
        }
        else return null;
    }

    public function getProductBySlug($slug){
        if($slug){
            $Product = $this->om->
            getRepository('IodogsDoctrine\Entity\Product')->
            findOneBy(array('slug' => $slug));
            if(!$this->checkInstance($Product))
                return null;
            return $Product;
        }
        else return null;

    }

    public function getFile(\IodogsDoctrine\Entity\Product $Product)
    {        
        return $Product->getFile();
    }

    public function getViewArrayByCollection($products){
        $viewArray = null;
        foreach ($products as $product) {
            $viewArray[] = $this->getViewArray($product);
        }
        return $viewArray;
    }

    public function getViewArray(\IodogsDoctrine\Entity\Product $Product)
    {
        $result = [
            "id" => $Product->getId(),
            "slug" => $Product->getSlug(),
            "tag" => $Product->getTag(),
            "category" => $Product->getCategory()->getId(),
            "line" => $Product->getLine(),
            "eng_title" => $Product->getEngTitle(),
            "rus_title" => $Product->getRusTitle(),
            "preview" => $Product->getPreview(),
            "vantage" => $Product->getVantage(),
            "card_text" => $Product->getCardText(),
            "application_text" => $Product->getApplication(),
            "ingredients" => $Product->getIngredients(),
            "sort" => $Product->getSortOrder(),
            "active" => $Product->getActive(),
            "in_stock" => $Product->getInStock(),
            "images" => $this->getImagesView($Product)
        ];

        if (!empty($this->partnerConfig['petgear']['tag_links_mapping']) && $Product->getTag() === $this->partnerConfig['petgear']['tag_links_mapping'])
        {
            $result['petgear_link'] = $this->partnerConfig['petgear']['tag_links_mapping'];
        }

        return $result;
    }

    public function getImagesView($Product, $default=true)
    {
        $files = $this->getFile($Product);
        return $this->imageService->getViewByArray($files,$default);
    }

    public function _getImages($productId)
    {
    	$productImages = null;
    	if ($productId)
    	{
            $Product =  $this->om->
            getRepository("\IodogsDoctrine\Entity\Product")->
            findOneBy(array("id" => $productId));          

        $productImages =  $this->om->
            getRepository("\IodogsDoctrine\Entity\ProductImage")->findBy(
                array("product" => $Product),
                array("sortOrder" => "ASC")
                );
    	}
    	return $productImages;
    }

    public function checkInstance($Product)
    {
        if($Product instanceof \IodogsDoctrine\Entity\Product)
            return true;
        return false;
    }

}