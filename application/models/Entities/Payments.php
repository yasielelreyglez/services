<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="payments")
 */
class Payments
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    public $id;

    /**
     *
     * @ManyToOne(targetEntity="Membership", inversedBy="payments")
     */
    protected $membership;

    /**  1-evidencia 2-en linea
     * @Column(type="integer")
     * @var int
     **/
    public $type;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $evidence;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $country;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $phone;

    /**
     *
     * @ManyToOne(targetEntity="Service", inversedBy="payments")
     */
    protected $service;

    /**
     * @Column(type="datetime")
     **/
    protected $updated_at;
    /**
     * @Column(type="datetime")
     **/
    protected $created_at;

    /**
     * @Column(type="datetime")
     **/
    protected $payed_at;
    /*ESTA ES LA VARIABLE DE CONTROL PARA SABER SI EL SERVICIO ES PRO TODAVIA*/


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