<?php
namespace IodogsCatalog\Service;

class LineService
{
    private $om;

    private $infoBlockService;

    public function __construct($om, $infoBlockService)
    {
        $this->om = $om;
        $this->infoBlockService = $infoBlockService;

    }


    public function getLineById($lineId){
        if($lineId>0){
            $Line = $this->om->getRepository('IodogsDoctrine\Entity\Line')->
            findOneBy(array('id' => $lineId));
            if($this->checkInstance($Line))
            return $Line;
        }
        return null;
    }

    public function getLineBySlug($slug){
        if($slug){
            $Line = $this->om->getRepository('IodogsDoctrine\Entity\Line')->
            findOneBy(array('slug' => $slug));
            if($this->checkInstance($Line))
            return $Line;
        }
       return null;
    }



    public function getLinesArray()
    {
        $Lines = $this->om->
        getRepository('IodogsDoctrine\Entity\Line')->
        findAll();
        foreach ($Lines as $Line) {
            $linesArray[] = $this->getViewArray($Line);
        }
        return $linesArray;
    }

    public function getViewArray($Line)
    {
        $linesArray = array();
        if($this->checkInstance($Line))
        {
            $linesArray = array(
                "id" => $Line->getId(),
                "slug" => $Line->getSlug(),
                "title" => $Line->getTitle(),
                "img_path" => $Line->getImgPath(),
                'info_block' => $this->infoBlockService->getViewArray($Line->getInfoBlock())
            );
        }
        return $linesArray;
    }

    public function checkInstance($Line)
    {
        if($Line instanceof \IodogsDoctrine\Entity\Line)
            return true;
        return false;
    }

}