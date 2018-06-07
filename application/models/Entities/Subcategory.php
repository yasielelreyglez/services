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
     * @Column(type="string")
     * @var string
     **/
    public $thumb;

    /**
     * @Column(type="integer")
     * @var integer
     **/
    public $visits;

    /**
     *
     * @ManyToOne(targetEntity="Category", inversedBy="subcategories")
     */
    public $category;

    /**
     * Many Subcategory have Many Services.
     * @ManyToMany(targetEntity="Service", mappedBy="subcategories")
     */
    public $services;

    public $servicesCount;
    /**
     * @Column(type="datetime")
     **/
    protected $created_at;

    /**
     * @Column(type="datetime")
     **/
    protected $updated_at;

    public function __construct()
    {
//        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
        $this->visits =0;
        $this->created_at = new \DateTime("now");
        $this->updated_at = new \DateTime("now");

    }

    public function getThumb(){
        return $this->thumb;
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

    public function setIcon($path,$icon)
    {
        $this->icon = site_url($path.$icon);
    }
    public function setThumb($path,$icon)
    {
        $this->thumb = site_url($path.$icon);
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

    /**
     * @return int
     */
    public function getVisits()
    {
        return $this->visits;
    }

    /**
     * @param int $visits
     */
    public function setVisits($visits)
    {
        $this->visits = $visits;
    }

}