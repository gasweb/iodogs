<?php
namespace IodogsFiles\Service;

use IodogsDoctrine\Entity\ImageStorage;

class ImageService
{

    /** @var \Doctrine\ORM\EntityManager */
    private $om;

    /** @var \IodogsFiles\Service\S3Service $s3Service */
    private $s3Service;

    public function __construct($om, $s3Service)
    {
        $this->om = $om;
        $this->s3Service = $s3Service;
    }

    public function getImages()
    {
        return $this->om->getRepository(ImageStorage::class)->findBy([], ['date' => 'desc']);
    }

    public function uploadImages($data, $config = [])
    {
        $result = [];
        $largeResizeWidth = (isset($config['large_width'])) ? $config['large_width'] : 1050;
        $largeResizeHeight = (isset($config['large_height'])) ? $config['large_height'] : 1050;
        $smallResizeWidth = (isset($config['small_width'])) ? $config['small_width'] : 300;
        $smallResizeHeight = (isset($config['small_height'])) ? $config['small_height'] : 300;

        if (isset($data) && is_array($data))
        {
            foreach ($data as $file) {
                $Imagick = new \Imagick();
                $ImageStorage = new ImageStorage();

                $name = sha1(microtime().mt_rand(0, 1000).mt_rand(1000, 9000));
                $small_file_name = $name.'-small';
                $tmp_dir = './data/tmp/';

                $Imagick->readImage($file['tmp_name']);

                $Imagick->resizeImage ( $largeResizeWidth, $largeResizeHeight,  \Imagick::FILTER_LANCZOS, 1, TRUE);
                $Imagick->writeImage($tmp_dir.$name.".jpg");

                $Imagick->resizeImage ( $smallResizeWidth, $smallResizeHeight,  \Imagick::FILTER_LANCZOS, 1, TRUE);

                $Imagick->writeImage($tmp_dir.$small_file_name.".jpg");

                $this->s3Service->putObject("public/dev/$name.jpg", $tmp_dir.$name.".jpg");
                $this->s3Service->putObject("public/dev/$small_file_name.jpg", $tmp_dir.$small_file_name.".jpg");

                $ImageStorage->setS3FilePath($this->s3Service->getPublicBucketLink()."public/dev/$name.jpg")->setS3SmallFilePath($this->s3Service->getPublicBucketLink()."public/dev/$small_file_name.jpg")->setDate(new \DateTime());

                $result[] = $ImageStorage;

                $this->om->persist($ImageStorage);
                $this->om->flush();

                unlink($tmp_dir.$name.".jpg");
                unlink($tmp_dir.$small_file_name.".jpg");
                unlink($file['tmp_name']);
            }
            return $result;
        }
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

    /**
     * @return S3Service
     */
    public function getS3Service()
    {
        return $this->s3Service;
    }

    /**
     * @param S3Service $s3Service
     */
    public function setS3Service($s3Service)
    {
        $this->s3Service = $s3Service;
    }

}