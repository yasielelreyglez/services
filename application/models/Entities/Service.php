<?php

namespace Entities {

    use Doctrine\Common\Collections\ArrayCollection;

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
         * @Column(type="boolean")
         * @var boolean
         **/
        public $enabled;

        /**
         * @Column(type="integer", nullable=true)
         * @var int
         **/
        public $professional;

        /**
         * @Column(type="string", nullable=true)
         * @var string
         **/
        public $icon;
        /**
         * @Column(type="string", nullable=true)
         * @var string
         **/
        public $thumb;

        /**
         * @Column(type="string", nullable=true)
         * @var string
         **/
        public $description;

        /**
         * @Column(type="string", nullable=true)
         * @var string
         **/
        public $subtitle;

        /**
         * @Column(type="string")
         * @var string
         **/
        public $phone;

        /**
         * @Column(type="string",nullable:true)
         * @var string
         **/
        public $whatsapp;
        /**
         * @Column(type="string",nullable=true)
         * @var string
         **/
        public $address;

        /**
         * @Column(type="string",nullable=true)
         * @var string
         **/
        public $other_phone;

        /**
         * @Column(type="string",nullable=true)
         * @var string
         **/
        public $email;

        /**
         * @Column(type="string",nullable=true)
         * @var string
         **/
        public $url;


        /**
         * @Column(type="integer")
         * @var integer
         **/
        public $visits;
        /**
         * Bidirectional - One-To-Many (INVERSE SIDE)
         *
         * @OneToMany(targetEntity="Times", mappedBy="service",cascade={"persist", "remove"})
         */
        public $times;
        public $timesList;
        /**
         * @Column(type="integer")
         * @var integer
         **/
        public $domicilio;

        /**
         * @Column(type="datetime")
         **/
        protected $created;

        /**
         * @Column(type="datetime")
         **/
        protected $created_at;

        /**
         * @Column(type="datetime",nullable=true)
         **/
        public $visit_at;

        /**
         * @Column(type="datetime")
         **/
        protected $updated_at;


        /**
         * @Column(type="integer")
         * @var integer
         **/
        public $todopais;

        //// relaciones
        /**
         * @ManyToOne(targetEntity="User", inversedBy="services")
         */
        public $author;

        /**
         * One User has Many UserService.
         * @OneToMany(targetEntity="Mensaje", mappedBy="service",cascade={"persist"})
         */
        private $mensajes;
        /**
         * Bidirectional - One-To-Many (INVERSE SIDE)
         *
         * @OneToMany(targetEntity="Position", mappedBy="service",cascade={"persist", "remove"})
         */
        protected $positions;
        public $positionsList;
        public $minorDistance;
        /**
         * Many services have Many cities.
         * @ManyToMany(targetEntity="City", inversedBy="services")
         * @JoinTable(name="service_city")
         */
        protected $cities;
        public $citiesList;
        /**
         * Many services have Many cities.
         * @ManyToMany(targetEntity="Subcategory", inversedBy="services")
         * @JoinTable(name="subcategory_service")
         */
        protected $subcategories;

        public $subcategoriesList;

//    /**
//     * Many services have Many Users.
//     * @ManyToMany(targetEntity="User", mappedBy="services")
//     */
//    private $users;

        /**
         * One User has Many UserService.
         * @OneToMany(targetEntity="UserService", mappedBy="service",cascade={"persist", "remove"})
         */
        protected $serviceusers;

        /**
         * @Column(type="float")
         * @var float
         **/
        public $globalrate;

        /**
         * @Column(type="float")
         * @var float
         **/
        public $ratereviews;

        /**
         * One User has Many UserService.
         * @OneToMany(targetEntity="Comments", mappedBy="service",cascade={"persist", "remove"})
         */
        protected $servicecomments;

        public $servicecommentsList;
        /**
         * Bidirectional - One-To-Many (INVERSE SIDE)
         *
         * @OneToMany(targetEntity="Image", mappedBy="service",cascade={"persist", "remove"})
         */
        private $images;




        public $imagesList;
        /////DATOS RELACIONADOS CON EL USUARIO
        ///
        public $visited;
        public $visited_at;
        public $contacted;
        public $complain;
        public $favorite;
        public $rated;
        /**
         *
         * @OneToMany(targetEntity="Payments", mappedBy="service",cascade={"persist", "remove"})
         */
        protected $payments;

        /**
         * Service constructor.
         */
        public function __construct()
        {
            $this->visits = 0;
            $this->domicilio = 0;
            $this->professional = 0;
            $this->todopais = 0;
            $this->created = new \DateTime("now");
            $this->created_at = new \DateTime("now");
            $this->updated_at = new \DateTime("now");
            $this->positions = new ArrayCollection();
            $this->cities = new ArrayCollection();
            $this->subcategories = new ArrayCollection();
            $this->serviceusers = new ArrayCollection();
            $this->servicecomments = new ArrayCollection();
            $this->images = new ArrayCollection();
            $this->payments = new ArrayCollection();
            $this->globalrate = 0;
            $this->ratereviews = 0;
            $this->enabled = 1;
        }
        //notificaciones

        /**
         * @return Mensaje
         */
        public function notificarComentario()
        {
            return $this->getAuthor()->notificarComentario($this);
        }

        /**
         * @return Mensaje
         */
        public function notificarDenuncia()
        {
            return $this->getAuthor()->notificarDenuncia($this);
        }

        /**
         * @return Mensaje
         */
        public function notificarBloqueo()
        {
            return $this->getAuthor()->notificarBloqueo($this);
        }

        /**
         * @return Mensaje
         */
        public function notificarPagoAceptado()
        {
            return $this->getAuthor()->notificarPagoAceptado($this);

        }

        public function getId()
        {
            return $this->id;
        }

        public function getTitle()
        {
            return $this->title;
        }

        public function getEnabled()
        {
            return $this->enabled;
        }

        public function setEnabled($enabled)
        {
            $this->enabled = $enabled;
        }

        public function setIcon($icon)
        {
            $this->icon = $icon;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function setEmail($email)
        {
            $this->email = $email;
        }

        /**
         * @return User
         */
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
         * @return \Doctrine\Common\Collections\Collection<Positions>
         */
        public function getPositions()
        {
            return $this->positions;
        }
        /**
         * Get mensajes
         *
         * @return \Doctrine\Common\Collections\Collection<Mensaje>
         */
        public function getMensajes()
        {
            return $this->mensates;
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
         * Add cities by ids
         *
         * @param array
         * @param Doctrine\ORM\EntityManager
         *
         * @return Service
         */
        public function addCities(array $cities, $em)
        {
            $actuales = $this->getCities()->toArray();
            foreach ($cities as $city_id) {
                $city = $em->find('\Entities\City', $city_id);
                if ($city) {
                    if (!in_array($city, $actuales)) {
                        $this->addCity($city);
                    }
                }
            }
            return $this;
        }

        /**
         * Add subcategories by ids
         *
         * @param array
         * @param Doctrine\ORM\EntityManager
         *
         * @return Service
         */
        public function addSubCategories(array $subcategories, $em)
        {
            $actuales = $this->getSubcategories()->toArray();
            foreach ($subcategories as $subcategory_id) {
                $subcategory = $em->find('\Entities\Subcategory', $subcategory_id);
                if (!in_array($subcategory, $actuales)) {
                    if ($subcategory) {
                        $this->addSubCategory($subcategory);
                    }
                }
            }
            return $this;
        }

        /**
         * Add city
         *
         * @param \Entities\City $city
         *
         * @return Service
         */
        public function addCity(City $city)
        {
            $this->cities[] = $city;

            return $this;
        }

        /**
         * Remove city
         *
         * @param \Entities\City $city
         */
        public function removeCity(City $city)
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
        public function removeServiceuser(UserService $serviceuser)
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
            $image->setService($this);
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

        public function addFotos(Array $fotos, $site_url, $backend = false)
        {
            if (!is_dir("./resources/services")) {
                mkdir("./resources/services/");
            }
            if (!is_dir("./resources/services/" . $this->id . "/")) {
                mkdir("./resources/services/" . $this->id . "/");
            }
            foreach ($fotos as $icon) {
                $path = "./resources/services/" . $this->id . "/" . $icon['filename'];
                $save_path = "resources/services/{$this->id}/{$icon['filename']}";
                $save_thumb = "resources/services/{$this->id}/thumbs/{$icon['filename']}";

                if ($backend == true) {
                    move_uploaded_file($icon['value'], $path);
                } else {
                    file_put_contents($path, base64_decode($icon['value']));
                }
                $image = new Image();
                $image->setTitle($save_path);
                createThumb($path, 700, 500);
                $image->setThumb($save_thumb);

                $this->addImage($image);
            }
            return $this;
        }

        public function addPositions(Array $positions, $admin = false)
        {
            foreach ($positions as $position) {
                $poss = new Position();
                if ($admin) {
                    $poss->setTitle($position->title);
                    $poss->setLatitude($position->latitude);
                    $poss->setLongitude($position->longitude);
                    $poss->setService($this);
                    $this->addPosition($poss);
                } else {
                    $poss->setTitle($position["title"]);
                    $poss->setLatitude($position["latitude"]);
                    $poss->setLongitude($position["longitude"]);
                    $poss->setService($this);
                    $this->addPosition($poss);
                }
            }
            return $this;
        }

        public function loadRelatedData($user = null, $current = null, $site_url = null)
        {
            $this->subcategoriesList = $this->getSubcategories()->toArray();
            $this->servicecommentsList = [];

            $temp = $this->getServicecomments()->toArray();
            foreach ($temp as $comment) {
                $usuario = $comment->getUser();
                $usuario->getUsername();
                $criteria = \Doctrine\Common\Collections\Criteria::create();
                $criteria->where(\Doctrine\Common\Collections\Criteria::expr()->eq('user', $usuario));
                $userservice = $this->serviceusers->matching($criteria);

                if ($this->professional) {
                    if (!$comment->hided || $user == $this->author) {
                        if (count($userservice) > 0) {
                            $us_obj = $userservice[0];
                            if ($us_obj != null)
                                $comment->rate = $us_obj->getRate();
                        }
                        $this->servicecommentsList[] = $comment;
                    }
                } else {
                    if (count($userservice) > 0) {
                        $arr = $userservice->toArray();
                        if (count($arr) > 0) {
                            $us_obj = $arr[0];

                            $comment->rate = $us_obj->getRate();
                        }
                    }
                    $this->servicecommentsList[] = $comment;
                }
            }
            $this->citiesList = $this->getCities()->toArray();
            $this->imagesList = [];
            if ($this->getProfessional()) {
                $this->imagesList = $this->getImages()->toArray();
            } else {
                $image = new Image();
                $image->setTitle($site_url . $this->getIcon());
                $image->setThumb($site_url . $this->getThumb());
                $this->imagesList = [];
                $this->imagesList[] = $image;
            }
            $this->positionsList = $this->getPositions()->toArray();
            $times = $this->getTimes();
            if ($times)
                $this->timesList = $this->getTimes()->toArray();
            else
                $this->timesList = [];
            if ($current) {
                foreach ($this->positionsList as $position) {
                    $position_distance = $position->Distance($current["latitude"], $current["longitude"]);
                    if (!$this->minorDistance || $this->minorDistance > $position_distance) {
                        $this->minorDistance = $position_distance;
                    }
                }
            }
            if ($user) {
                $this->loadRelatedUserData($user);
            }
            $this->icon = $site_url . $this->icon;
            $this->thumb = $site_url . $this->thumb;
        }

        //relacionar la info con el usuario y salvarlo en la bd
        public function relateUserData($user, $em)
        {
            $criteria = new \Doctrine\Common\Collections\Criteria();
            //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
            $expresion = new \Doctrine\Common\Collections\Expr\Comparison("user", \Doctrine\Common\Collections\Expr\Comparison::EQ, $user);
            $criteria = $criteria->where($expresion);

            $relacion = $this->getServiceusers()->matching($criteria)->toArray();
            if (count($relacion) > 0) {
//
                $userservice = array_pop($relacion);
            } else {
                $userservice = new UserService();

            }
            $userservice->setService($this);

            $userservice->setUser($user);
            $userservice->setVisited(1);
            $userservice->setVisitedAt(new \DateTime("now"));
//            $this->visit_at = new \DateTime("now");
            $em->persist($this);
            $em->persist($userservice);
            $em->flush();

        }

        //carga la informacion relacionada con el usuario en la bd para devolver en la api
        public function loadRelatedUserData($user)
        {
            $criteria = new \Doctrine\Common\Collections\Criteria();
            //AQUI TODAS LAS EXPRESIONES POR LAS QUE SE PUEDE BUSCAR CON TEXTO
            $expresion = new \Doctrine\Common\Collections\Expr\Comparison("user", \Doctrine\Common\Collections\Expr\Comparison::EQ, $user);
            $criteria = $criteria->where($expresion);

            $relacion = $this->getServiceusers()->matching($criteria)->toArray();
            if (count($relacion) > 0) {
//
                $relacion = array_pop($relacion);
                $this->visited = $relacion->getVisited();
                $this->visited_at = $relacion->getVisitedAt();
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

        /**
         * @param mixed $serviceusers
         * @return Service
         */
        public function setServiceusers($serviceusers)
        {
            $this->serviceusers = $serviceusers;
            return $this;
        }

        /**
         * @param float $globalrate
         * @return Service
         */
        public function setGlobalrate($globalrate)
        {
            $this->globalrate = $globalrate;
            return $this;
        }

        /**
         * @param int $visits
         * @return Service
         */
        public function setVisits($visits)
        {
            $this->visits = $visits;
            $subcategories = $this->getSubcategories();
            foreach ($subcategories as $subcategory) {
                $subcategory->setVisits($subcategory->getVisits() + 1);
            }
            return $this;
        }

        /**
         * @return int
         */
        public function getVisits()
        {
            return $this->visits;
        }

        /**
         * @return mixed
         */
        public function getServicecomments()
        {
            return $this->servicecomments;
        }

        /**
         * @param mixed $servicecomments
         */
        public function setServicecomments($servicecomments)
        {
            $this->servicecomments = $servicecomments;
        }

        /**
         * @return string
         */
        public function getDescription()
        {
            return $this->description;
        }

        /**
         * @param string $description
         */
        public function setDescription($description)
        {
            $this->description = $description;
        }

        /**
         * @return int
         */
        public function getProfessional()
        {
            return $this->professional;
        }

        /**
         * @param int $professional
         */
        public function setProfessional($professional)
        {
            $this->professional = $professional;
            return $this;
        }

        /**
         * @return \Doctrine\Common\Collections\Collection
         */
        public function getPayments()
        {
            return $this->payments;
        }

        /**
         * @param mixed $payments
         */
        public function setPayments($payments)
        {
            $this->payments = $payments;
        }

        /**
         * @return float
         */
        public function getGlobalrate()
        {
            return $this->globalrate;
        }

        public function getReviews()
        {
            return $this->ratereviews;
        }

        /**
         * @return Service
         */
        function calculateGlobalRate()
        {

            $sum = 0;
            $countRates = 0;
            $rates = $this->getServiceusers();
            foreach ($rates as $rel) {
                if ($rel->getRate()) {
                    $sum += $rel->getRate();
                    $countRates += 1;
                }
            }
            $this->setGlobalrate($sum / $countRates);
            $this->ratereviews = $countRates;
            return $this;
        }

        /**
         * @return string
         */
        public function getIcon()
        {
            return $this->icon;
        }

        /**
         * @param mixed $times
         */
        public function setTimes($times)
        {
            $this->times = $times;
        }

        public function addTimes(Array $times, $admin = false)
        {

            foreach ($times as $time_p) {
                $time = new Times();
                $poss = 0;
                $string_week = "";
                if ($admin) {
                    $weekdays = $time_p->week_days;
                    if(!is_array($weekdays)){
                        $weekdays = explode(",",$weekdays);
                    }
                } else {
                    $weekdays = $time_p["weekdays"];
                }
                //print_r($weekdays);
                foreach ($weekdays as $weekday) {
                    if ($poss > 6) {
                        $poss = 0;
                    }
                    if ($admin) {
                        $string_week = $string_week . "," . $weekday;
                    } else {
                        if ($weekday) {

                            $string_week = $string_week . "," . $poss;
                        }
                    }
                    $poss++;
                }
                $time->setWeekDays(substr($string_week, 1));
                if ($admin) {
                    $time->setEndTime($time_p->end_time);
                    $time->setStartTime($time_p->start_time);
                } else {
                    $time->setEndTime($time_p["end_time"]);
                    $time->setStartTime($time_p["start_time"]);
                }
                $time->setService($this);
                $this->addTime($time);
            }

            return $this;
        }

        /**
         * Add time
         *
         * @param \Entities\Times $time
         *
         * @return Service
         */
        public function addTime(Times $time)
        {
            $this->times[] = $time;

            return $this;
        }

        /**
         * @return mixed
         */
        public function getTimes()
        {
            return $this->times;
        }

        /**
         * @return int
         */
        public function getTodopais()
        {
            return $this->todopais;
        }

        /**
         * @param int $todopais
         */
        public function setTodopais($todopais)
        {
            $this->todopais = $todopais;
        }

        /**
         * @return string
         */
        public function getThumb()
        {
            return $this->thumb;
        }

        /**
         * @param string $thumb
         */
        public function setThumb($thumb)
        {
            createThumb("./resources/services/$thumb", 700, 500);
            $this->thumb = "/resources/services/thumbs/$thumb";
        }

        /**
         * @return string
         */
        public function getWhatsapp()
        {
            return $this->whatsapp;
        }

        /**
         * @param string $whatsapp
         */
        public function setWhatsapp($whatsapp)
        {
            $this->whatsapp = $whatsapp;
        }
    }

    function createThumb($sImagen, $nWidth = false, $nHeight = false)
    {
        // Variables
        $sNombre = null;
        $sPath = null;
        $sExt = null;
        $aImage = null;
        $aThumb = null;
        $aImageMarco = null;
        $ImTransparente = null;
        $aSize = null;
        $nWidthMarco = false;
        $nWidthHeight = false;
        $nX = false;
        $nY = false;

        // Obtenemos el nombre de la imagen
        $sNombre = basename($sImagen);
        // Obtenemos la ruta especificada para buscar la imagen
        $sPath = dirname($sImagen) . '/';
        // Obtenemos la extension de la imagen

        $sExt = mime_content_type($sImagen);
        // Creamos el directorio thumbs
        if (!is_dir($sPath . 'thumbs/'))
            @mkdir($sPath . 'thumbs/', 0777, true) or die('No se ha podido crear el directorio "' . $sPath . 'thumbs/".');

        // Creamos la imagen a partir del tipo
        switch ($sExt) {
            // Imagen JPG
            case 'image/jpeg':
                $aImage = @imageCreateFromJpeg($sImagen);
                break;
            // Imagen GIF
            case 'image/gif':
                $aImage = @imageCreateFromGif($sImagen);
                break;
            // Imagen PNG
            case 'image/png':
                $aImage = @imageCreateFromPng($sImagen);
                break;
            // Imagen BMP
            case 'image/wbmp':
                $aImage = @imageCreateFromWbmp($sImagen);
                break;
            default:
                return 'No se conoce el tipo de imagen enviado, por favor cambie el formato. Sólo se permiten imágenes *.jpg, *.gif, *.png ó *.bmp.';
                break;
        }

        // Obtenemos el tamaño de la imagen original
        $aSize = getImageSize($sImagen);

        // Calculamos las proporciones de la imagen //

        // Obteniendo el alto (Recogiendo ancho y no alto)
        if ($nWidth !== false && $nHeight === false)
            $nHeight = round(($aSize[1] * $nWidth) / $aSize[0]);
        // Obteniendo el ancho (Recogiendo alto y no ancho)
        elseif ($nWidth === false && $nHeight !== false)
            $nWidth = round(($aSize[0] * $nHeight) / $aSize[1]);
        // Obteniendo proporciones (Recogiendo alto y ancho)
        elseif ($nWidth !== false && $nHeight !== false) {
            // Guardamos las dimensiones del marco
            $nWidthMarco = $nWidth;
            $nHeightMarco = $nHeight;
//
//            // Si el ancho es mayor
//            if( $nWidth < $nHeight )
//            {
//                $nHeight = round( ( $aSize[1] * $nWidth ) / $aSize[0] );
//                $nX = 0;
//                $nY = round( ( $nHeightMarco - $nHeight ) / 2 );
//            }
//            // Si el alto es mayor
//            elseif( $nHeight < $nWidth )
//            {
//                $nWidth = round( ( $aSize[0] * $nHeight ) / $aSize[1] );
//                $nX = round( ( $nWidthMarco - $nWidth ) / 2 );;
//                $nY = 0;
//            }
        } // El ancho y el alto no se han enviado, informamos del error
        elseif ($nWidth === false && $nHeight === false)
            return 'No se ha especificado ningún valor para el ancho y el alto de la imágen.';

        // La nueva imagen reescalada
        $aThumb = imageCreateTrueColor($nWidth, $nHeight);

        // Reescalamos
        imageCopyResampled($aThumb, $aImage, 0, 0, 0, 0, $nWidth, $nHeight, $aSize[0], $aSize[1]);

        // Si tenemos que crear el marco
        /*if( $nWidthMarco !== false && $nHeightMarco !== false )
        {
            // El marco
            $aImageMarco = imageCreateTrueColor( $nWidthMarco, $nHeightMarco );

            // Establecemos la imagen de fondo transparente
            imageAlphaBlending( $aImageMarco, false );
            imageSaveAlpha( $aImageMarco, true );

            // Establecemos el color transparente (negro)
            $ImTransparente = imageColorAllocateAlpha( $aImageMarco, 0, 0, 0, 0xff/2 );

            // Ponemos el fondo transparente
            imageFilledRectangle( $aImageMarco, 0, 0, $nWidthMarco, $nHeightMarco, $ImTransparente );

            // Combinamos las imagenes
            imageCopyResampled( $aImageMarco, $aThumb, $nX, $nY, 0, 0, $nWidth, $nHeight, $nWidth, $nHeight );

            // Cambiamos la instancia
            $aThumb = $aImageMarco;
        }*/

        // Salvamos
        imagePng($aThumb, $sPath . 'thumbs/' . $sNombre);

        // Liberamos
        imageDestroy($aImage);
        imageDestroy($aThumb);

        return true;
    }

    function mime_content_type2($sImagen)
    {
        return trim(exec('file -bi ' . escapeshellarg($sImagen)));
    }


}