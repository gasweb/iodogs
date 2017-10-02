<?php
namespace IodogsApplication\Service;

use \IodogsApplication\Interfaces\IodogsServiceInterface;

class InfoBlockService implements IodogsServiceInterface
{

    protected $om;

    public function __construct($objectManager)
    {
        $this->om = $objectManager;
    }

    public function findPageBySlug($id)
    {
        $InfoBlock = $this->om-> getRepository('IodogsDoctrine\Entity\InfoBlock')->
        findOneBy(array('id' => $id));
        return $InfoBlock;
    }


    public function checkInstance($instance)
    {
        if($instance instanceof \IodogsDoctrine\Entity\InfoBlock)
            return true;
        return false;
    }

    public function getViewArray($InfoBlockEntity)
    {
        $viewArray = array();
        if($this->checkInstance($InfoBlockEntity))
        {
            $viewArray = array(
                'id' => $InfoBlockEntity->getId(),
                'title' => $InfoBlockEntity->getTitle(),
                'header' => $InfoBlockEntity->getHeader(),
                'snippet' => $InfoBlockEntity->getSnippet(),
                'keywords' => $InfoBlockEntity->getKeywords(),
                'decription' => $InfoBlockEntity->getDescription(),
                'content' => $InfoBlockEntity->getContent(),
                'date_update' => $InfoBlockEntity->getDateUpdate(),
            );
        }
        return $viewArray;
    }
}