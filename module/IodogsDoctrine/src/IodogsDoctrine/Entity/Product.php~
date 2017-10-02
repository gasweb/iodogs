<?php

namespace IodogsDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product", indexes={@ORM\Index(name="IDX_D34A04AD64C19C1", columns={"category"})})
 * @ORM\Entity
 */
class Product
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
     * @ORM\Column(name="eng_title", type="string", length=100, nullable=true)
     */
    private $engTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="rus_title", type="string", length=100, nullable=true)
     */
    private $rusTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=200, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=40, nullable=true)
     */
    private $tag;

    /**
     * @var string
     *
     * @ORM\Column(name="sort_order", type="integer", nullable=true, options={"default":100})
     */
    private $sortOrder;

    /**
     * @var string
     *
     * @ORM\Column(name="preview", type="text", length=65535, nullable=true)
     */
    private $preview;

    /**
     * @var string
     *
     * @ORM\Column(name="vantage", type="text", length=65535, nullable=true)
     */
    private $vantage;

    /**
     * @var string
     *
     * @ORM\Column(name="card_text", type="text", length=65535, nullable=true)
     */
    private $cardText;

    /**
     * @var string
     *
     * @ORM\Column(name="application", type="text", length=65535, nullable=true)
     */
    private $application;

    /**
     * @var string
     *
     * @ORM\Column(name="ingredients", type="text", length=65535, nullable=true)
     */
    private $ingredients;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var boolean
     *
     * @ORM\Column(name="in_stock", type="boolean", nullable=true)
     */
    private $inStock;

    /**
     * @var integer
     *
     * @ORM\Column(name="line", type="integer", nullable=true)
     */
    private $line;

    /**
     * @var integer
     *
     * @ORM\Column(name="thumb_id", type="integer", nullable=true)
     */
    private $thumbId;

    /**
     * @var \IodogsDoctrine\Entity\Category
     *
     * @ORM\ManyToOne(targetEntity="IodogsDoctrine\Entity\Category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category", referencedColumnName="id", nullable=true)
     * })
     */
    private $category;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="IodogsDoctrine\Entity\Breed", mappedBy="product")
     */
    private $breed;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="IodogsDoctrine\Entity\Solution", mappedBy="product")
     */
    private $solution;



    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="IodogsDoctrine\Entity\FileStorage", inversedBy="product")
     * @ORM\JoinTable(name="product_image",
     *   joinColumns={
     *     @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="file_id", referencedColumnName="id")
     *   }
     * )
     */
    private $file;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="IodogsDoctrine\Entity\Review", mappedBy="product")
     */
    private $review;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->breed = new \Doctrine\Common\Collections\ArrayCollection();
        $this->solution = new \Doctrine\Common\Collections\ArrayCollection();
        $this->file = new \Doctrine\Common\Collections\ArrayCollection();
        $this->review = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set engTitle
     *
     * @param string $engTitle
     * @return Product
     */
    public function setEngTitle($engTitle)
    {
        $this->engTitle = $engTitle;

        return $this;
    }

    /**
     * Get engTitle
     *
     * @return string 
     */
    public function getEngTitle()
    {
        return $this->engTitle;
    }

    /**
     * Set rusTitle
     *
     * @param string $rusTitle
     * @return Product
     */
    public function setRusTitle($rusTitle)
    {
        $this->rusTitle = $rusTitle;

        return $this;
    }

    /**
     * Get rusTitle
     *
     * @return string 
     */
    public function getRusTitle()
    {
        return $this->rusTitle;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Product
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set tag
     *
     * @param string $tag
     * @return Product
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string 
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set sortOrder
     *
     * @param integer $sortOrder
     * @return Product
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
     * Set preview
     *
     * @param string $preview
     * @return Product
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;

        return $this;
    }

    /**
     * Get preview
     *
     * @return string 
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * Set vantage
     *
     * @param string $vantage
     * @return Product
     */
    public function setVantage($vantage)
    {
        $this->vantage = $vantage;

        return $this;
    }

    /**
     * Get vantage
     *
     * @return string 
     */
    public function getVantage()
    {
        return $this->vantage;
    }

    /**
     * Set cardText
     *
     * @param string $cardText
     * @return Product
     */
    public function setCardText($cardText)
    {
        $this->cardText = $cardText;

        return $this;
    }

    /**
     * Get cardText
     *
     * @return string 
     */
    public function getCardText()
    {
        return $this->cardText;
    }

    /**
     * Set application
     *
     * @param string $application
     * @return Product
     */
    public function setApplication($application)
    {
        $this->application = $application;

        return $this;
    }

    /**
     * Get application
     *
     * @return string 
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * Set ingredients
     *
     * @param string $ingredients
     * @return Product
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    /**
     * Get ingredients
     *
     * @return string 
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Product
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set inStock
     *
     * @param boolean $inStock
     * @return Product
     */
    public function setInStock($inStock)
    {
        $this->inStock = $inStock;

        return $this;
    }

    /**
     * Get inStock
     *
     * @return boolean 
     */
    public function getInStock()
    {
        return $this->inStock;
    }

    /**
     * Set line
     *
     * @param integer $line
     * @return Product
     */
    public function setLine($line)
    {
        $this->line = $line;

        return $this;
    }

    /**
     * Get line
     *
     * @return integer 
     */
    public function getLine()
    {
        return $this->line;
    }

    /**
     * Set thumbId
     *
     * @param integer $thumbId
     * @return Product
     */
    public function setThumbId($thumbId)
    {
        $this->thumbId = $thumbId;

        return $this;
    }

    /**
     * Get thumbId
     *
     * @return integer 
     */
    public function getThumbId()
    {
        return $this->thumbId;
    }

    /**
     * Set category
     *
     * @param \IodogsDoctrine\Entity\Category $category
     * @return Product
     */
    public function setCategory(\IodogsDoctrine\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \IodogsDoctrine\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add breed
     *
     * @param \IodogsDoctrine\Entity\Breed $breed
     * @return Product
     */
    public function addBreed(\IodogsDoctrine\Entity\Breed $breed)
    {
        $this->breed[] = $breed;

        return $this;
    }

    /**
     * Remove breed
     *
     * @param \IodogsDoctrine\Entity\Breed $breed
     */
    public function removeBreed(\IodogsDoctrine\Entity\Breed $breed)
    {
        $this->breed->removeElement($breed);
    }

    /**
     * Get breed
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * Add solution
     *
     * @param \IodogsDoctrine\Entity\Solution $solution
     * @return Product
     */
    public function addSolution(\IodogsDoctrine\Entity\Solution $solution)
    {
        $this->solution[] = $solution;

        return $this;
    }

    /**
     * Remove solution
     *
     * @param \IodogsDoctrine\Entity\Solution $solution
     */
    public function removeSolution(\IodogsDoctrine\Entity\Solution $solution)
    {
        $this->solution->removeElement($solution);
    }

    /**
     * Get solution
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSolution()
    {
        return $this->solution;
    }

    /**
     * Add file
     *
     * @param \IodogsDoctrine\Entity\FileStorage $file
     * @return Product
     */
    public function addFile(\IodogsDoctrine\Entity\FileStorage $file)
    {
        $this->file[] = $file;

        return $this;
    }

    /**
     * Remove file
     *
     * @param \IodogsDoctrine\Entity\FileStorage $file
     */
    public function removeFile(\IodogsDoctrine\Entity\FileStorage $file)
    {
        $this->file->removeElement($file);
    }

    /**
     * Get file
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Add review
     *
     * @param \IodogsDoctrine\Entity\Review $review
     * @return Product
     */
    public function addReview(\IodogsDoctrine\Entity\Review $review)
    {
        $this->review[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \IodogsDoctrine\Entity\Review $review
     */
    public function removeReview(\IodogsDoctrine\Entity\Review $review)
    {
        $this->review->removeElement($review);
    }

    /**
     * Get review
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReview()
    {
        return $this->review;
    }
}
