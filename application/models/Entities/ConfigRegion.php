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
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $region;

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
}