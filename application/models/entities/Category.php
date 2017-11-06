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
        $this->subcategories = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add subcategory
     *
     * @param \Entities\Subcategory $subcategory
     *
     * @return Category
     */
    public function addSubcategory(\Entities\Subcategory $subcategory)
    {
        $this->subcategories[] = $subcategory;

        return $this;
    }

    /**
     * Remove subcategory
     *
     * @param \Entities\Subcategory $subcategory
     */
    public function removeSubcategory(\Entities\Subcategory $subcategory)
    {
        $this->subcategories->removeElement($subcategory);
    }

    /**
     * Get subcategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubcategories()
    {
        return $this->subcategories;
    }

}