<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="membership")
 */
class Membership
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
     * @Column(type="float")
     * @var float
     **/
    public $price;

    /**
     * @Column(type="integer")
     * @var int
     **/
    public $days;

    /**
     * @Column(type="datetime")
     **/
    protected $created_at;

    /**
     * @Column(type="datetime")
     **/
    protected $updated_at;

    /**
     *
     * @OneToMany(targetEntity="Payments", mappedBy="membership")
     */
    protected $payments;

    public function __construct()
    {
        $this->created_at = new \DateTime("now");
        $this->updated_at = new \DateTime("now");
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
    /**
     * Add service
     *
     * @param \Entities\Service $service
     *
     * @return City
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
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @param int $days
     */
    public function setDays($days)
    {
        $this->days = $days;
    }

}