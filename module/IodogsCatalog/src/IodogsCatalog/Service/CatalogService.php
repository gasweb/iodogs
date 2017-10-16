<?php
namespace IodogsCatalog\Service;

//use Zend\ServiceManager\ServiceLocatorAwareInterface;
//use Zend\ServiceManager\ServiceLocatorInterface;

class CatalogService
{
    /** @var \Doctrine\ORM\EntityManager $objectManager */
	private $objectManager;

	private $infoBlockService;

    public function __construct($objectManager, $infoBlockService)
    {
        $this->objectManager = $objectManager;       
        $this->infoBlockService = $infoBlockService;
    }

   public function getCategoryById($categoryId){
        if($categoryId>0){             
            $Category = $this->objectManager->
            getRepository('IodogsDoctrine\Entity\Category')->
            findOneBy(array('id' => $categoryId));
            if(!is_object($Category))
                throw new \Exception("Категории с id $categoryId не найдено"); 
            return $Category;
        }
        else throw new \Exception("Id категории не задано");  

    }
/*Нужно дописать функцию которая будет делать выборку массива категорий */
    public function getCategoriesArray()
    {           
            $Categories = $this->objectManager->
            getRepository('IodogsDoctrine\Entity\Category')->
            findAll();
            foreach ($Categories as $Category) {
                $categoriesArray[] = array(
                    "id" => $Category->getId(),
                    "title" => $Category->getTitle(),
                    );
            }
            return $categoriesArray;


    }
    public function getCategoryArrayById($categoryId)
    {            
            $Categories = $this->objectManager->
            getRepository('IodogsDoctrine\Entity\Category')->
            findBy(array("id"=>$categoryId));
        

    }
    public function getViewArray($Category)
    {
        return array(
            'id' => $Category->getId(),
            'slug' => $Category->getSlug(),
            'info_block' => $this->infoBlockService->getViewArray($Category->getInfoBlock())
        );
    }
   public function getCategoryProducts()
   {
       # code...
   }

    /**
     * @param $slug
     * @return mixed
     */
    public function getCategoryBySlug($slug)
    {
        if(!empty($slug))
        {
            $Category = $this->objectManager->
            getRepository('IodogsDoctrine\Entity\Category')->
            findOneBy(array('slug' => $slug));
            if($Category instanceof \IodogsDoctrine\Entity\Category)
            return $Category;

            return null;
        }
    }

    public function checkInstance($Category)
    {
        if($Category instanceof \IodogsDoctrine\Entity\Category)
            return true;
        return false;
    }

}