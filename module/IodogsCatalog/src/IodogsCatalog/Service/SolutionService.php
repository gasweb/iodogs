<?php
namespace IodogsCatalog\Service;

class SolutionService
{
    private $om;

    private $infoBlockService;

    public function __construct($om, $infoBlockService)
    {
        $this->om = $om;
        $this->infoBlockService = $infoBlockService;

    }

    public function getSolutionBySlug($slug)
    {
        if($slug){
            $Solution = $this->om->getRepository('IodogsDoctrine\Entity\Solution')->
            findOneBy(array('slug' => $slug));
            return $Solution;
        }
    }

    public function getSolutionById($id)
    {
        if($id){
            $Solution = $this->om->getRepository('IodogsDoctrine\Entity\Solution')->
            findOneBy(array('id' => $id));
            return $Solution;
        }
    }

    public function getSolutionArray()
    {
        $solutions = $this->om->
        getRepository('IodogsDoctrine\Entity\Solution')->
        findAll();
        foreach ($solutions as $solution) {
            $solutionArray[] = $this->getViewArray($solution);
        }
        return $solutionArray;
    }

    public function getViewArray($Solution)
    {
        $solutionsArray = array();
        if($this->checkInstance($Solution))
        {
            $solutionsArray = array(
                "id" => $Solution->getId(),
                "slug" => $Solution->getSlug(),
                "title" => $Solution->getTitle(),
                "img_path" => $Solution->getImgPath(),
                'info_block' => $this->infoBlockService->getViewArray($Solution->getInfoBlock())
            );
        }
        return $solutionsArray;
    }

    public function checkInstance($Solution)
    {
        if($Solution instanceof \IodogsDoctrine\Entity\Solution)
            return true;
        return false;
    }

}