<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="cities")
 */
class City
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

    // ...
    /**
     * Many Groups have Many Users.
     * @ManyToMany(targetEntity="Service", mappedBy="cities")
     */
    private $services;
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

}