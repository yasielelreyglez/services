<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="services")
 */
class Service
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
    protected $subtitle;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $phone;


    /**
     * @Column(type="string")
     * @var string
     **/
    protected $address;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $other_phone;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $email;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $url;
    /**
     * @Column(type="string")
     * @var string
     **/
    protected $week_days;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $start_time;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $end_time;

    /**
     * @Column(type="datetime")
     **/
    protected $created;

    public function __construct()
    {
        $this->created = new \DateTime("now");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getCreated()
    {
        return $this->created;
    }
}