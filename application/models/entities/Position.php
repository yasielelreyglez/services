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
     * @Column(type="double")
     * @var string
     **/
    protected $latitude;

    /**
     * @Column(type="double")
     * @var string
     **/
    protected $longitude;

    /**
     * Bidirectional - One-To-Many (INVERSE SIDE)
     *
     * @OneToMany(targetEntity="Subcategory", mappedBy="category")
     */
    private $subcategories;

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