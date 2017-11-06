<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="positions")
 */
class Position
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $title;

    /**
     * @Column(type="float")
     * @var string
     **/
    protected $latitude;

    /**
     * @Column(type="float")
     * @var string
     **/
    protected $longitude;

    /**
     * @ManyToOne(targetEntity="Service", inversedBy="positions")
     */
    private $service;

    public function __construct()
    {

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
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Position
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Position
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set service
     *
     * @param \Entities\Service $service
     *
     * @return Position
     */
    public function setService(\Entities\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \Entities\Service
     */
    public function getService()
    {
        return $this->service;
    }
}