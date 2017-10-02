<?php
namespace IodogsBreed\Service;

use Zend\Paginator\Adapter\ArrayAdapter;

class BreedService
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $om;

    /**
     * @var \IodogsFiles\Service\S3Service
     */
    private $s3Service;

    /**
     * @var \IodogsFiles\Service\ImageService
     */
    private $imageService;

    /**
     * @var \IodogsApplication\Service\Factory\InfoBlockServiceFactory
     */
    private $infoBlockService;



    public function __construct($om, $s3Service, $imageService, $infoBlockService)
    {
        $this->om = $om;
        $this->s3Service = $s3Service;
        $this->imageService = $imageService;
        $this->infoBlockService = $infoBlockService;
    }

    public function getBreeds()
    {
        $breeds = $this->om->
                getRepository('IodogsDoctrine\Entity\Breed')->
                findBy(array(),array('rusTitle' => 'ASC'));
            return $breeds;
    }

    public function getBreedById($breedId=null)
    {
        if($breedId){
            $Breed = $this->om->find('IodogsDoctrine\Entity\Breed', $breedId);
            return $Breed;
        }
    }
    
     public function getBreedBySlug($slug)
        {
            if($slug){
                $Breed = $this->om->getRepository('IodogsDoctrine\Entity\Breed')->findOneBy(array('slug' => $slug));
                return $Breed;
            }
        }




    public function getViewInfoByArray($breeds=null)
    {
        $breedArray = array();
        if(is_array($breeds))
            foreach ($breeds AS $breed) 
                $breedArray[] = $this->getViewArray($breed);
        return $breedArray;
    }

    public function getViewInfo($Breed)
    {
        return Array(
                "id" => $Breed->getId(),
                "rus_title" => $Breed->getRusTitle(),
                "eng_title" => $Breed->getEngTitle(),
                "file_name" => $Breed->getFileName(),
                );    
    }

    public function getViewArray($Breed)
    {
        $viewArray = array();
        if($this->checkInstance($Breed))
            $viewArray = Array(
            "id" => $Breed->getId(),
            "slug" => $Breed->getSlug(),
            "rus_title" => $Breed->getRusTitle(),
            "eng_title" => $Breed->getEngTitle(),
            "file_path" => $this->getFilePath($Breed),
            'info_block' => $this->infoBlockService->getViewArray($Breed->getInfoBlock())
        );
        return $viewArray;
    }

    public function getFilePath($Breed)
    {
        if(!empty($Breed->getFileName()))
        return $this->s3Service->getPublicBucketLink()."breeds/".$Breed->getFileName();
        else return '/img/default/breed.png';

    }

    public function checkInstance($Breed)
    {
        if($Breed instanceof \IodogsDoctrine\Entity\Breed)
            return true;
        return false;
    }


}