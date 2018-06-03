<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="pages")
 */
class Pages
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
    public $Content;

    /**
     *
     * @OneToMany(targetEntity="ConfigRegion", mappedBy="pages",cascade={"persist", "remove"})
     */
    protected $configregion;

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
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
        $this->updated_at = new \DateTime("now");
        $this->created_at = new \DateTime("now");
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
     * Remove service
     *
     * @param \Entities\Service $service
     */
    public function removeService(\Entities\Service $service)
    {
        $this->services->removeElement($service);
    }

     /**
     * @return string
     */
    public function getContent()
    {
        return $this->Content;
    }

    /**
     * @param string $Content
     */
    public function setContent($Content)
    {
        $this->Content = $Content;
    }

}