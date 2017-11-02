<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="categories")
 */
class Category
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

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
    }
    public function __toString()
    {
        return $this->getTitle();
    }

}