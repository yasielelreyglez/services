<?php
/**
 * Created by PhpStorm.
 * User: Kenny
 * Date: 5/30/2018
 * Time: 11:58 PM
 */
namespace Entities;

/**
 * @Entity
 * @Table(name="banners")
 */
class Banner
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
    public $name;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $title;

    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    public $subtitle;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $image;

    /**
     *
     * @OneToMany(targetEntity="ConfigRegion", mappedBy="banners",cascade={"persist", "remove"})
     */
    public $configregion;

    /**
     * @Column(type="datetime")
     **/
    public $created_at;

    /**
     * @Column(type="datetime")
     **/
    public $updated_at;

    public function __construct()
    {
        $this->updated_at = new \DateTime("now");
        $this->created_at = new \DateTime("now");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->updated_at = new \DateTime("now");
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->updated_at = new \DateTime("now");
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
        $this->updated_at = new \DateTime("now");
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        $this->updated_at = new \DateTime("now");
    }
    public function __toString()
    {
        return $this->getTitle();
    }
}