<?php
namespace IodogsFiles\Service;

class ImageService
{

    private $om;

    public function __construct($om, $s3Service)
    {
        $this->om = $om;
        $this->s3Service = $s3Service;
    }

    public function deleteImageById($photoId)
    {
        $File = $this->getImageById($photoId);
        if($File instanceof \IodogsDoctrine\Entity\FileStorage)
        {
            $File->setIsDelete(1);
            $this->om->persist($File);
            $this->om->flush();
        }
    }

    public function getImageById($photoId)
    {
        $photoId = (int) $photoId;
        if($photoId)
        {
            $File = $this->om->
            getRepository("\IodogsDoctrine\Entity\FileStorage")->
            findOneBy(
                array(
                    'id' => $photoId
                )
            );
            return $File;
        }
    }

    public function checkType($File)
    {
        if($File instanceof \IodogsDoctrine\Entity\FileStorage)
            return true;
        return false;
    }

    public function checkToEdit($File)
    {
        if($this->checkType($File) && $File->getIsDelete() != 1)
            return true;
        return false;
    }

    /**
     * @param $files
     * @param bool $default
     * @return array
     */
    public function getViewByArray($files, $default=false){
        $returnArray = array();
        foreach ($files AS $File)
        {
            if($this->checkToEdit($File))
            {
                $returnArray[] = $this->getViewArray($File);
            }
        }
        if(is_array($returnArray) && !empty($returnArray))
        {
            foreach ($returnArray as $key => $row) {
                $sort[$key]  = $row['sort'];
            }
            array_multisort($sort, SORT_ASC, $returnArray);
        }
        elseif($default)
            $returnArray = $this->getDefaultViewArray();
        return $returnArray;
    }

    public function getViewArray($File)
    {
        if($this->checkType($File))
        {
            $s3BucketLink = $this->s3Service->getPublicBucketLink();
            return array(
                'id' => $File->getId(),
                'sort' => $File->getSortOrder(),
              'src' => $s3BucketLink.$File->getS3FilePath(),
              'src_small' => $s3BucketLink.$File->getS3SmallFilePath(),
            );
        }

    }

    public function getDefaultViewArray(){
        return array(
            array(
                'id' => null,
                'src' => '/img/default/no-image.png',
                'src_small' => '/img/default/no-image.png',
                'description' => 'Нет доступного изображения',
                'sort' => '0'
            )
        );
    }

}