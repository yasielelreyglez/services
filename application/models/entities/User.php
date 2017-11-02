<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="users")
 */
class User
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
    protected $username;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $email;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $password;

    /**
     * @Column(type="datetime")
     **/
    protected $created;

    /**
     * @Column(type="integer")
     * @var integer
     **/
    protected $role;

    /**
     * One User has Many UserService.
     * @OneToMany(targetEntity="UserService", mappedBy="user")
     */
    private $userservices;
    /**
     * Bidirectional - One-To-Many (INVERSE SIDE)
     *
     * @OneToMany(targetEntity="Service", mappedBy="author")
     */
    protected $service;
//    /**
//     * Many users have Many services.
//     * @ManyToMany(targetEntity="Service", inversedBy="users")
////     * @JoinTable(name="service_user")
//     */
//    protected $services;

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

    public function getRole()
    {
        return $this->role;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
    public function getCreated()
    {
        return $this->created;
    }
}