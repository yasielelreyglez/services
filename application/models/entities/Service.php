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


    //// relaciones
    /**
     * @ManyToOne(targetEntity="User", inversedBy="services")
     */
    private $author;

    /**
     * Many services have Many cities.
     * @ManyToMany(targetEntity="City", inversedBy="services")
     * @JoinTable(name="service_city")
     */
    private $cities;

//    /**
//     * Many services have Many Users.
//     * @ManyToMany(targetEntity="User", mappedBy="services")
//     */
//    private $users;

    /**
     * One User has Many UserService.
     * @OneToMany(targetEntity="UserService", mappedBy="service")
     */
    private $serviceusers;
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
    public function getAuthor()
    {
        return $this->author;
    }

    public function setAthor($author)
    {
        $this->author = $author;
    }
    public function getCreated()
    {
        return $this->created;
    }
}