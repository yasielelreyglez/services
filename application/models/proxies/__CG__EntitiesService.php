<?php

namespace Proxies\__CG__\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Service extends \Entities\Service implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = ['title' => NULL, 'professional' => NULL, 'icon' => NULL, 'thumb' => NULL, 'description' => NULL, 'subtitle' => NULL, 'phone' => NULL, 'address' => NULL, 'other_phone' => NULL, 'email' => NULL, 'url' => NULL, 'visits' => NULL, 'times' => NULL, 'domicilio' => NULL, 'visit_at' => NULL, 'todopais' => NULL, 'author' => NULL, 'globalrate' => NULL, 'ratereviews' => NULL, 'imagesList' => NULL];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {
        unset($this->title, $this->professional, $this->icon, $this->thumb, $this->description, $this->subtitle, $this->phone, $this->address, $this->other_phone, $this->email, $this->url, $this->visits, $this->times, $this->domicilio, $this->visit_at, $this->todopais, $this->author, $this->globalrate, $this->ratereviews, $this->imagesList);

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }

    /**
     * 
     * @param string $name
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__get', [$name]);

            return $this->$name;
        }

        trigger_error(sprintf('Undefined property: %s::$%s', __CLASS__, $name), E_USER_NOTICE);
    }

    /**
     * 
     * @param string $name
     * @param mixed  $value
     */
    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__set', [$name, $value]);

            $this->$name = $value;

            return;
        }

        $this->$name = $value;
    }

    /**
     * 
     * @param  string $name
     * @return boolean
     */
    public function __isset($name)
    {
        if (array_key_exists($name, $this->__getLazyProperties())) {
            $this->__initializer__ && $this->__initializer__->__invoke($this, '__isset', [$name]);

            return isset($this->$name);
        }

        return false;
    }

    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', 'id', 'title', 'professional', 'icon', 'thumb', 'description', 'subtitle', 'phone', 'address', 'other_phone', 'email', 'url', 'visits', 'times', 'timesList', 'domicilio', 'created', 'created_at', 'visit_at', 'updated_at', 'todopais', 'author', 'positions', 'positionsList', 'minorDistance', 'cities', 'citiesList', 'subcategories', 'subcategoriesList', 'serviceusers', 'globalrate', 'ratereviews', 'servicecomments', 'servicecommentsList', '' . "\0" . 'Entities\\Service' . "\0" . 'images', 'imagesList', 'visited', 'visited_at', 'contacted', 'complain', 'favorite', 'rated', 'payments'];
        }

        return ['__isInitialized__', 'id', 'timesList', 'created', 'created_at', 'updated_at', 'positions', 'positionsList', 'minorDistance', 'cities', 'citiesList', 'subcategories', 'subcategoriesList', 'serviceusers', 'servicecomments', 'servicecommentsList', '' . "\0" . 'Entities\\Service' . "\0" . 'images', 'visited', 'visited_at', 'contacted', 'complain', 'favorite', 'rated', 'payments'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Service $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

            unset($this->title, $this->professional, $this->icon, $this->thumb, $this->description, $this->subtitle, $this->phone, $this->address, $this->other_phone, $this->email, $this->url, $this->visits, $this->times, $this->domicilio, $this->visit_at, $this->todopais, $this->author, $this->globalrate, $this->ratereviews, $this->imagesList);
        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function notificarComentario()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'notificarComentario', []);

        return parent::notificarComentario();
    }

    /**
     * {@inheritDoc}
     */
    public function notificarDenuncia()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'notificarDenuncia', []);

        return parent::notificarDenuncia();
    }

    /**
     * {@inheritDoc}
     */
    public function notificarBloqueo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'notificarBloqueo', []);

        return parent::notificarBloqueo();
    }

    /**
     * {@inheritDoc}
     */
    public function notificarPagoAceptado()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'notificarPagoAceptado', []);

        return parent::notificarPagoAceptado();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTitle', []);

        return parent::getTitle();
    }

    /**
     * {@inheritDoc}
     */
    public function setIcon($icon)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIcon', [$icon]);

        return parent::setIcon($icon);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmail()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmail', []);

        return parent::getEmail();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmail($email)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmail', [$email]);

        return parent::setEmail($email);
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthor()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAuthor', []);

        return parent::getAuthor();
    }

    /**
     * {@inheritDoc}
     */
    public function setAthor($author)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAthor', [$author]);

        return parent::setAthor($author);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreated()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreated', []);

        return parent::getCreated();
    }

    /**
     * {@inheritDoc}
     */
    public function setPhone($phone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPhone', [$phone]);

        return parent::setPhone($phone);
    }

    /**
     * {@inheritDoc}
     */
    public function getPhone()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPhone', []);

        return parent::getPhone();
    }

    /**
     * {@inheritDoc}
     */
    public function setAddress($address)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAddress', [$address]);

        return parent::setAddress($address);
    }

    /**
     * {@inheritDoc}
     */
    public function getAddress()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAddress', []);

        return parent::getAddress();
    }

    /**
     * {@inheritDoc}
     */
    public function setOtherPhone($otherPhone)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOtherPhone', [$otherPhone]);

        return parent::setOtherPhone($otherPhone);
    }

    /**
     * {@inheritDoc}
     */
    public function getOtherPhone()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOtherPhone', []);

        return parent::getOtherPhone();
    }

    /**
     * {@inheritDoc}
     */
    public function setUrl($url)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUrl', [$url]);

        return parent::setUrl($url);
    }

    /**
     * {@inheritDoc}
     */
    public function getUrl()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUrl', []);

        return parent::getUrl();
    }

    /**
     * {@inheritDoc}
     */
    public function setWeekDays($weekDays)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setWeekDays', [$weekDays]);

        return parent::setWeekDays($weekDays);
    }

    /**
     * {@inheritDoc}
     */
    public function getWeekDays()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getWeekDays', []);

        return parent::getWeekDays();
    }

    /**
     * {@inheritDoc}
     */
    public function setStartTime($startTime)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStartTime', [$startTime]);

        return parent::setStartTime($startTime);
    }

    /**
     * {@inheritDoc}
     */
    public function getStartTime()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStartTime', []);

        return parent::getStartTime();
    }

    /**
     * {@inheritDoc}
     */
    public function setEndTime($endTime)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEndTime', [$endTime]);

        return parent::setEndTime($endTime);
    }

    /**
     * {@inheritDoc}
     */
    public function getEndTime()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEndTime', []);

        return parent::getEndTime();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreated($created)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreated', [$created]);

        return parent::setCreated($created);
    }

    /**
     * {@inheritDoc}
     */
    public function setAuthor(\Entities\User $author = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAuthor', [$author]);

        return parent::setAuthor($author);
    }

    /**
     * {@inheritDoc}
     */
    public function addPosition(\Entities\Position $position)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addPosition', [$position]);

        return parent::addPosition($position);
    }

    /**
     * {@inheritDoc}
     */
    public function removePosition(\Entities\Position $position)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removePosition', [$position]);

        return parent::removePosition($position);
    }

    /**
     * {@inheritDoc}
     */
    public function getPositions()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPositions', []);

        return parent::getPositions();
    }

    /**
     * {@inheritDoc}
     */
    public function addSubCategory(\Entities\Subcategory $subcategory)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addSubCategory', [$subcategory]);

        return parent::addSubCategory($subcategory);
    }

    /**
     * {@inheritDoc}
     */
    public function removeSubcategory(\Entities\Subcategory $subcategory)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeSubcategory', [$subcategory]);

        return parent::removeSubcategory($subcategory);
    }

    /**
     * {@inheritDoc}
     */
    public function getSubcategories()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSubcategories', []);

        return parent::getSubcategories();
    }

    /**
     * {@inheritDoc}
     */
    public function addCities(array $cities, $em)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addCities', [$cities, $em]);

        return parent::addCities($cities, $em);
    }

    /**
     * {@inheritDoc}
     */
    public function addSubCategories(array $subcategories, $em)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addSubCategories', [$subcategories, $em]);

        return parent::addSubCategories($subcategories, $em);
    }

    /**
     * {@inheritDoc}
     */
    public function addCity(\Entities\City $city)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addCity', [$city]);

        return parent::addCity($city);
    }

    /**
     * {@inheritDoc}
     */
    public function removeCity(\Entities\City $city)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeCity', [$city]);

        return parent::removeCity($city);
    }

    /**
     * {@inheritDoc}
     */
    public function getCities()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCities', []);

        return parent::getCities();
    }

    /**
     * {@inheritDoc}
     */
    public function addServiceuser(\Entities\UserService $serviceuser)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addServiceuser', [$serviceuser]);

        return parent::addServiceuser($serviceuser);
    }

    /**
     * {@inheritDoc}
     */
    public function removeServiceuser(\Entities\UserService $serviceuser)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeServiceuser', [$serviceuser]);

        return parent::removeServiceuser($serviceuser);
    }

    /**
     * {@inheritDoc}
     */
    public function addImage(\Entities\Image $image)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addImage', [$image]);

        return parent::addImage($image);
    }

    /**
     * {@inheritDoc}
     */
    public function removeImage(\Entities\Image $image)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeImage', [$image]);

        return parent::removeImage($image);
    }

    /**
     * {@inheritDoc}
     */
    public function getImages()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getImages', []);

        return parent::getImages();
    }

    /**
     * {@inheritDoc}
     */
    public function addFotos(array $fotos, $site_url, $backend = false)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addFotos', [$fotos, $site_url, $backend]);

        return parent::addFotos($fotos, $site_url, $backend);
    }

    /**
     * {@inheritDoc}
     */
    public function addPositions(array $positions, $admin = false)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addPositions', [$positions, $admin]);

        return parent::addPositions($positions, $admin);
    }

    /**
     * {@inheritDoc}
     */
    public function loadRelatedData($user = NULL, $current = NULL, $site_url = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'loadRelatedData', [$user, $current, $site_url]);

        return parent::loadRelatedData($user, $current, $site_url);
    }

    /**
     * {@inheritDoc}
     */
    public function relateUserData($user, $em)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'relateUserData', [$user, $em]);

        return parent::relateUserData($user, $em);
    }

    /**
     * {@inheritDoc}
     */
    public function loadRelatedUserData($user)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'loadRelatedUserData', [$user]);

        return parent::loadRelatedUserData($user);
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceusers()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getServiceusers', []);

        return parent::getServiceusers();
    }

    /**
     * {@inheritDoc}
     */
    public function setServiceusers($serviceusers)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setServiceusers', [$serviceusers]);

        return parent::setServiceusers($serviceusers);
    }

    /**
     * {@inheritDoc}
     */
    public function setGlobalrate($globalrate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setGlobalrate', [$globalrate]);

        return parent::setGlobalrate($globalrate);
    }

    /**
     * {@inheritDoc}
     */
    public function setVisits($visits)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setVisits', [$visits]);

        return parent::setVisits($visits);
    }

    /**
     * {@inheritDoc}
     */
    public function getVisits()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getVisits', []);

        return parent::getVisits();
    }

    /**
     * {@inheritDoc}
     */
    public function getServicecomments()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getServicecomments', []);

        return parent::getServicecomments();
    }

    /**
     * {@inheritDoc}
     */
    public function setServicecomments($servicecomments)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setServicecomments', [$servicecomments]);

        return parent::setServicecomments($servicecomments);
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescription', []);

        return parent::getDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription($description)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDescription', [$description]);

        return parent::setDescription($description);
    }

    /**
     * {@inheritDoc}
     */
    public function getProfessional()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProfessional', []);

        return parent::getProfessional();
    }

    /**
     * {@inheritDoc}
     */
    public function setProfessional($professional)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProfessional', [$professional]);

        return parent::setProfessional($professional);
    }

    /**
     * {@inheritDoc}
     */
    public function getPayments()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPayments', []);

        return parent::getPayments();
    }

    /**
     * {@inheritDoc}
     */
    public function setPayments($payments)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPayments', [$payments]);

        return parent::setPayments($payments);
    }

    /**
     * {@inheritDoc}
     */
    public function getGlobalrate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getGlobalrate', []);

        return parent::getGlobalrate();
    }

    /**
     * {@inheritDoc}
     */
    public function getReviews()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReviews', []);

        return parent::getReviews();
    }

    /**
     * {@inheritDoc}
     */
    public function calculateGlobalRate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'calculateGlobalRate', []);

        return parent::calculateGlobalRate();
    }

    /**
     * {@inheritDoc}
     */
    public function getIcon()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIcon', []);

        return parent::getIcon();
    }

    /**
     * {@inheritDoc}
     */
    public function setTimes($times)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTimes', [$times]);

        return parent::setTimes($times);
    }

    /**
     * {@inheritDoc}
     */
    public function addTimes(array $times, $admin = false)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addTimes', [$times, $admin]);

        return parent::addTimes($times, $admin);
    }

    /**
     * {@inheritDoc}
     */
    public function addTime(\Entities\Times $time)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addTime', [$time]);

        return parent::addTime($time);
    }

    /**
     * {@inheritDoc}
     */
    public function getTimes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTimes', []);

        return parent::getTimes();
    }

    /**
     * {@inheritDoc}
     */
    public function getTodopais()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTodopais', []);

        return parent::getTodopais();
    }

    /**
     * {@inheritDoc}
     */
    public function setTodopais($todopais)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTodopais', [$todopais]);

        return parent::setTodopais($todopais);
    }

    /**
     * {@inheritDoc}
     */
    public function getThumb()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getThumb', []);

        return parent::getThumb();
    }

    /**
     * {@inheritDoc}
     */
    public function setThumb($thumb)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setThumb', [$thumb]);

        return parent::setThumb($thumb);
    }

}
