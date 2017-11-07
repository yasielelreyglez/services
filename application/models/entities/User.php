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
     * @Column(type="string")
     * @var string
     **/
    protected $ip_address;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $remember_code;
    /**
     * @Column(type="string")
     * @var string
     **/
    protected $salt;

    /**
     * @Column(type="datetime")
     **/
    protected $created_on;

    /**
     * @Column(type="datetime")
     **/
    protected $last_login;

    /**
     * @Column(type="integer")
     * @var integer
     **/
    protected $active;



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
     * One User has Many UserService.
     * @OneToMany(targetEntity="Comments", mappedBy="user")
     */
    private $usercomments;
    /**
     * Bidirectional - One-To-Many (INVERSE SIDE)
     *
     * @OneToMany(targetEntity="Service", mappedBy="author")
     */
    protected $services;
//    /**
//     * Many users have Many services.
//     * @ManyToMany(targetEntity="Service", inversedBy="users")
////     * @JoinTable(name="service_user")
//     */
//    protected $services;

    public function __construct()
    {
        $this->created = new \DateTime("now");
        $this->userservices = new \Doctrine\Common\Collections\ArrayCollection();
        $this->usercomments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
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
    /**
     * Add userservice
     *
     * @param \Entities\UserService $userservice
     *
     * @return User
     */
    public function addUserservice(\Entities\UserService $userservice)
    {
        $this->userservices[] = $userservice;

        return $this;
    }

    /**
     * Remove userservice
     *
     * @param \Entities\UserService $userservice
     */
    public function removeUserservice(\Entities\UserService $userservice)
    {
        $this->userservices->removeElement($userservice);
    }

    /**
     * Get userservices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserservices()
    {
        return $this->userservices;
    }

    /**
     * Add usercomment
     *
     * @param \Entities\Comments $usercomment
     *
     * @return User
     */
    public function addUsercomment(\Entities\Comments $usercomment)
    {
        $this->usercomments[] = $usercomment;

        return $this;
    }

    /**
     * Remove usercomment
     *
     * @param \Entities\Comments $usercomment
     */
    public function removeUsercomment(\Entities\Comments $usercomment)
    {
        $this->usercomments->removeElement($usercomment);
    }

    /**
     * Get usercomments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsercomments()
    {
        return $this->usercomments;
    }

    /**
     * Add service
     *
     * @param \Entities\Service $service
     *
     * @return User
     */
    public function addService(\Entities\Service $service)
    {
        $this->services[] = $service;

        return $this;
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
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }
}