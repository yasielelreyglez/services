<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="subcategories")
 */
class Subcategory
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    public $id;



    /**
     * @Column(type="string")
     * @var string
     **/
    public $title;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $icon;

    /**
     * @Column(type="integer")
     * @var integer
     **/
    public $visits;

    /**
     *
     * @ManyToOne(targetEntity="Category", inversedBy="subcategories")
     */
    protected $category;

    /**
     * Many Subcategory have Many Services.
     * @ManyToMany(targetEntity="Service", mappedBy="subcategories")
     */
    public $services;

    public function __construct()
    {
//        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }
    /**
     * Set category
     *
     * @param \Entities\Category $category
     *
     * @return Subcategory
     */
    public function setCategory(\Entities\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Entities\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add service
     *
     * @param \Entities\Service $service
     *
     * @return Subcategory
     */
    public function addService(\Entities\Service $service)
    {
        $this->services[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \Entities\Service $service
     */
    public function removeService(\Entities\Service $service)
    {
        $this->services->removeElement($service);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }

}