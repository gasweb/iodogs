<?php

namespace IodogsDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Id\UuidGenerator;

/**
 * FileStorage
 *
 * @ORM\Table(name="image_storage")
 * @ORM\Entity
 */
class ImageStorage
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="string", length=64, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="s3_file_path", type="string", length=256, nullable=false)
     */
    private $s3FilePath;

    /**
     * @var string
     *
     * @ORM\Column(name="s3_small_file_path", type="string", length=256, nullable=false)
     */
    private $s3SmallFilePath;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="sort_order", type="integer", nullable=true, options={"default" = 100})
     */
    private $sortOrder = 100;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

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
     * @return string
     */
    public function getS3FilePath()
    {
        return $this->s3FilePath;
    }

    /**
     * @param string $s3FilePath
     * @return ImageStorage
     */
    public function setS3FilePath($s3FilePath)
    {
        $this->s3FilePath = $s3FilePath;
        return $this;
    }

    /**
     * @return string
     */
    public function getS3SmallFilePath()
    {
        return $this->s3SmallFilePath;
    }

    /**
     * @param string $s3SmallFilePath
     * @return ImageStorage
     */
    public function setS3SmallFilePath($s3SmallFilePath)
    {
        $this->s3SmallFilePath = $s3SmallFilePath;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return ImageStorage
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return int
     */
    public function getSortOrder()
    {
        return $this->sortOrder;
    }

    /**
     * @param int $sortOrder
     * @return ImageStorage
     */
    public function setSortOrder($sortOrder)
    {
        $this->sortOrder = $sortOrder;
        return $this;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return ImageStorage
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
}
