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
    public $icon;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $subtitle;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $phone;


    /**
     * @Column(type="string")
     * @var string
     **/
    public $address;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $other_phone;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $email;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $url;
    /**
     * @Column(type="string")
     * @var string
     **/
    public $week_days;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $start_time;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $end_time;

    /**
     * @Column(type="integer")
     * @var integer
     **/
    public $visits;
    /**
     * @Column(type="datetime")
     **/
    protected $created;

    /**
     * @Column(type="datetime")
     **/
    protected $created_at;

    /**
     * @Column(type="datetime")
     **/
    protected $updated_at;



    //// relaciones
    /**
     * @ManyToOne(targetEntity="User", inversedBy="services")
     */
    public $author;

    /**
     * Bidirectional - One-To-Many (INVERSE SIDE)
     *
     * @OneToMany(targetEntity="Position", mappedBy="service")
     */
    public $positions;

    /**
     * Many services have Many cities.
     * @ManyToMany(targetEntity="City", inversedBy="services")
     * @JoinTable(name="service_city")
     */
    public $cities;

    /**
     * Many services have Many cities.
     * @ManyToMany(targetEntity="Subcategory", inversedBy="services")
     * @JoinTable(name="subcategory_service")
     */
    public $subcategories;

//    /**
//     * Many services have Many Users.
//     * @ManyToMany(targetEntity="User", mappedBy="services")
//     */
//    private $users;

    /**
     * One User has Many UserService.
     * @OneToMany(targetEntity="UserService", mappedBy="service")
     */
    public $serviceusers;

    /**
     * One User has Many UserService.
     * @OneToMany(targetEntity="Comments", mappedBy="service")
     */
    public $servicecomments;


    /**
     * Bidirectional - One-To-Many (INVERSE SIDE)
     *
     * @OneToMany(targetEntity="Image", mappedBy="service")
     */
    private $images;

    /////DATOS RELACIONADOS CON EL USUARIO
    ///
    public $visited;
    public $contacted;
    public $complain;
    public $favorite;
    public $rated;


    public function __construct()
    {
        $this->created = new \DateTime("now");
        $this->created_at = new \DateTime("now");
        $this->updated_at = new \DateTime("now");
        $this->positions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subcategories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->serviceusers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->servicecomments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }
    public function getTitle()
    {
        return $this->title;
    }

    public function setIcon($icon){
        $this->icon = $icon;
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
    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Service
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Service
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set otherPhone
     *
     * @param string $otherPhone
     *
     * @return Service
     */
    public function setOtherPhone($otherPhone)
    {
        $this->other_phone = $otherPhone;

        return $this;
    }

    /**
     * Get otherPhone
     *
     * @return string
     */
    public function getOtherPhone()
    {
        return $this->other_phone;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Service
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set weekDays
     *
     * @param string $weekDays
     *
     * @return Service
     */
    public function setWeekDays($weekDays)
    {
        $this->week_days = $weekDays;

        return $this;
    }

    /**
     * Get weekDays
     *
     * @return string
     */
    public function getWeekDays()
    {
        return $this->week_days;
    }

    /**
     * Set startTime
     *
     * @param string $startTime
     *
     * @return Service
     */
    public function setStartTime($startTime)
    {
        $this->start_time = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return string
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * Set endTime
     *
     * @param string $endTime
     *
     * @return Service
     */
    public function setEndTime($endTime)
    {
        $this->end_time = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return string
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Service
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }


    /**
     * Set author
     *
     * @param \Entities\User $author
     *
     * @return Service
     */
    public function setAuthor(User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Add position
     *
     * @param \Entities\Position $position
     *
     * @return Service
     */
    public function addPosition(Position $position)
    {
        $this->positions[] = $position;

        return $this;
    }

    /**
     * Remove position
     *
     * @param \Entities\Position $position
     */
    public function removePosition(Position $position)
    {
        $this->positions->removeElement($position);
    }

    /**
     * Get positions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * Add position
     *
     * @param \Entities\Subcategory $subcategory
     *
     * @return Service
     */
    public function addSubCategory(Subcategory $subcategory)
    {
        $this->subcategories[] = $subcategory;
        return $this;
    }

    /**
     * Remove position
     *
     * @param \Entities\Subcategory $subcategory
     */
    public function removeSubcategory(Subcategory $subcategory)
    {
        $this->subcategories->removeElement($subcategory);
    }

    /**
     * Get subcategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubcategories()
    {
        return $this->subcategories;
    }
    /**
     * Add city
     *
     * @param \Entities\City $city
     *
     * @return Service
     */
    public function addCity(\Entities\City $city)
    {
        $this->cities[] = $city;

        return $this;
    }

    /**
     * Remove city
     *
     * @param \Entities\City $city
     */
    public function removeCity(\Entities\City $city)
    {
        $this->cities->removeElement($city);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities()
    {
        return $this->cities;
    }

    /**
     * Add serviceuser
     *
     * @param \Entities\UserService $serviceuser
     *
     * @return Service
     */
    public function addServiceuser(\Entities\UserService $serviceuser)
    {
        $this->serviceusers[] = $serviceuser;

        return $this;
    }

    /**
     * Remove serviceuser
     *
     * @param \Entities\UserService $serviceuser
     */
    public function removeServiceuser(\Entities\UserService $serviceuser)
    {
        $this->serviceusers->removeElement($serviceuser);
    }



    /**
     * Add Image
     *
     * @param \Entities\Image $image
     *
     * @return Service
     */
    public function addImage(Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \Entities\Image $image
     */
    public function removeImage(Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }



    public function loadRelatedUserData($user){
        $criteria = new \Doctrine\Common\Collections\Criteria();
        //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
        $expresion = new \Doctrine\Common\Collections\Expr\Comparison("user",\Doctrine\Common\Collections\Expr\Comparison::EQ,$user);
        $criteria->where($expresion);
        $relacion = $this->getServiceusers()->matching($criteria)->toArray();
        if(count($relacion)>0){
            $relacion = $relacion[0];
            $this->visited = $relacion->getVisited();
            $this->rated = $relacion->getRate();
            $this->complain = $relacion->getComplaint();
            $this->contacted = $relacion->getContacted();
            $this->favorite = $relacion->getFavorite();

        }

        return $relacion;
    }

    /**
     * Get serviceusers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServiceusers()
    {
        return $this->serviceusers;
    }
}