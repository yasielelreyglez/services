<?php
/**
 * Created by PhpStorm.
 * User: Kenny
 * Date: 6/2/2018
 * Time: 8:33 PM
 */

namespace Entities;



/**
 * @Entity
 * @Table(name="configregion")
 */
class ConfigRegion
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
    public $region;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $groupRegion;

    /**
     * Bidirectional - One-To-Many (INVERSE SIDE)
     *
     * @ManyToOne(targetEntity="Pages", inversedBy="configregion")
     */
    public $page;
    public $pageList;

    /**
     * Bidirectional - One-To-Many (INVERSE SIDE)
     *
     * @ManyToOne(targetEntity="Banner", inversedBy="configregion")
     */
    public $banner;
    public $bannerList;

    /**
     * @Column(type="datetime")
     **/
    protected $created_at;

    /**
     * @Column(type="datetime")
     **/
    protected $updated_at;

    public function __construct()
    {
        $this->updated_at = new \DateTime("now");
        $this->created_at = new \DateTime("now");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function setRegion($region)
    {
        $this->region = $region;
        $this->updated_at = new \DateTime("now");
    }

    public function getGroupRegion()
    {
        return $this->groupRegion;
    }

    public function setGroupRegion($groupRegion)
    {
        $this->groupRegion = $groupRegion;
        $this->updated_at = new \DateTime("now");
    }

    public function getBanner()
    {
        return $this->banner;
    }

    public function setBanner($banner)
    {
        $this->banner = $banner;
        $this->updated_at = new \DateTime("now");
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage($page)
    {
        $this->page = $page;
        $this->updated_at = new \DateTime("now");
    }
}