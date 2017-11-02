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
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $title;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $icon;


    /**
     * Unidirectional - Many-To-One
     *
     * @ManyToOne(targetEntity="Category", inversedBy="subcategories")
     */
    private $category;

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

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

}