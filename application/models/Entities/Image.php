<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="images")
 */
class Image
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
     *
     * @ManyToOne(targetEntity="Service", inversedBy="images")
     */
    protected $service;


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
     * Set service
     *
     * @param \Entities\Service $service
     *
     * @return Imagen
     */
    public function setService(Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Entities\Service
     */
    public function getService()
    {
        return $this->service;
    }
}