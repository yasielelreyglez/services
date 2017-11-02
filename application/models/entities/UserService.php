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
 * @Table(name="service_user")
 */
class UserService
{
    /**
    * Many Features have One Product.
    * @Id @ManyToOne(targetEntity="User", inversedBy="userserices")
     */
    private $user;

    /**
     * Many Features have One Product.
     * @Id @ManyToOne(targetEntity="Service", inversedBy="serviceusers")
     */
    private $service;

    /**
     * @Column(type="integer")
     * @var int
     **/
    protected $favorite;

    /**
     * @Column(type="integer")
     * @var int
     **/
    protected $rate;

    /**
     * @Column(type="integer")
     * @var int
     **/
    protected $contacted;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $complaint;

    /**
     * @Column(type="datetime")
     **/
    protected $complaint_created;
}