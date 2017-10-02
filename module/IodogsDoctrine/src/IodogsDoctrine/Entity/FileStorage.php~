<?php

namespace IodogsDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FileStorage
 *
 * @ORM\Table(name="file_storage")
 * @ORM\Entity
 */
class FileStorage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="small_file_name", type="string", length=100, nullable=false)
     */
    private $smallFileName;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=100, nullable=false)
     */
    private $fileName;

    /**
     * @var string
     *
     * @ORM\Column(name="s3_small_file_path", type="string", length=200, nullable=false)
     */
    private $s3SmallFilePath;

    /**
     * @var string
     *
     * @ORM\Column(name="s3_file_path", type="string", length=200, nullable=false)
     */
    private $s3FilePath;

    /**
     * @var string
     *
     * @ORM\Column(name="dir_name", type="string", length=100, nullable=false)
     */
    private $dirName;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort_order", type="integer", nullable=true)
     */
    private $sortOrder;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_delete", type="boolean", nullable=true)
     */
    private $isDelete;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="IodogsDoctrine\Entity\Product", mappedBy="file")
     */
    private $product;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set smallFileName
     *
     * @param string $smallFileName
     * @return FileStorage
     */
    public function setSmallFileName($smallFileName)
    {
        $this->smallFileName = $smallFileName;

        return $this;
    }

    /**
     * Get smallFileName
     *
     * @return string 
     */
    public function getSmallFileName()
    {
        return $this->smallFileName;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     * @return FileStorage
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string 
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set s3SmallFilePath
     *
     * @param string $s3SmallFilePath
     * @return FileStorage
     */
    public function setS3SmallFilePath($s3SmallFilePath)
    {
        $this->s3SmallFilePath = $s3SmallFilePath;

        return $this;
    }

    /**
     * Get s3SmallFilePath
     *
     * @return string 
     */
    public function getS3SmallFilePath()
    {
        return $this->s3SmallFilePath;
    }

    /**
     * Set s3FilePath
     *
     * @param string $s3FilePath
     * @return FileStorage
     */
    public function setS3FilePath($s3FilePath)
    {
        $this->s3FilePath = $s3FilePath;

        return $this;
    }

    /**
     * Get s3FilePath
     *
     * @return string 
     */
    public function getS3FilePath()
    {
        return $this->s3FilePath;
    }

    /**
     * Set dirName
     *
     * @param string $dirName
     * @return FileStorage
     */
    public function setDirName($dirName)
    {
        $this->dirName = $dirName;

        return $this;
    }

    /**
     * Get dirName
     *
     * @return string 
     */
    public function getDirName()
    {
        return $this->dirName;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return FileStorage
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set sortOrder
     *
     * @param integer $sortOrder
     * @return FileStorage
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;

        return $this;
    }

    /**
     * Get sortOrder
     *
     * @return integer 
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * Set isDelete
     *
     * @param boolean $isDelete
     * @return FileStorage
     */
    public function setIsDelete($isDelete)
    {
        $this->isDelete = $isDelete;

        return $this;
    }

    /**
     * Get isDelete
     *
     * @return boolean 
     */
    public function getIsDelete()
    {
        return $this->isDelete;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return FileStorage
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add product
     *
     * @param \IodogsDoctrine\Entity\Product $product
     * @return FileStorage
     */
    public function addProduct(\IodogsDoctrine\Entity\Product $product)
    {
        $this->product[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \IodogsDoctrine\Entity\Product $product
     */
    public function removeProduct(\IodogsDoctrine\Entity\Product $product)
    {
        $this->product->removeElement($product);
    }

    /**
     * Get product
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduct()
    {
        return $this->product;
    }
}
