<?php
/**
 * Created by PhpStorm.
 * User: saul
 * Date: 11/2/2017
 * Time: 4:48 PM
 */
//service_user
namespace Entities;

/**
 * @Entity
 * @Table(name="comments")
 */
class Comments
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    public $id;
    /**
    * Many Features have One Product.
    * @ManyToOne(targetEntity="User", inversedBy="usercomments")
     */
    public $user;

    /**
     * Many Features have One Product.
     * @ManyToOne(targetEntity="Service", inversedBy="servicecomments")
     */
    public $service;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $comment;

    /**
     * @Column(type="integer")
     * @var int
     **/
    public $parent;


    /**
     * @Column(type="datetime")
     **/
    public $created;

    /**
     * Set user
     *
     * @param \Entities\User $user
     *
     * @return Comments
     */
    public function setUser(\Entities\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Entities\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set service
     *
     * @param \Entities\Service $service
     *
     * @return Comments
     */
    public function setService(\Entities\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \Entities\Service
     */
    public function getService()
    {
        return $this->service;
    }
}