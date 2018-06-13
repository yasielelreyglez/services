<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="positions")
 */
class Position
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
     * @Column(type="float")
     * @var string
     **/
    public $latitude;

    /**
     * @Column(type="float")
     * @var string
     **/
    public $longitude;

    /**
     * @Column(type="datetime")
     **/
    protected $created_at;
    /**
     * @Column(type="datetime")
     **/
    protected $updated_at;

    /**
     * @ManyToOne(targetEntity="Service", inversedBy="positions")
     */
    private $service;

    public function __construct()
    {
        $this->created_at = new \DateTime("now");
        $this->updated_at = new \DateTime("now");
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
     * Set latitude
     *
     * @param float $latitude
     *
     * @return Position
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return Position
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set service
     *
     * @param \Entities\Service $service
     *
     * @return Position
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

    public function isInRange($distance, $current_position)
    {
        //TODO CALCULAR SI ESTA EN EL RANGO
        $current_distance = $this->Distance($current_position["latitude"],$current_position["longitude"]);
        if($current_distance<=$distance){
            return true;
        }
        return false;
    }

     function Distance($lat1, $lon1 )
    {
        $lat2 = $this->latitude;
        $lon2 = $this->longitude;
        $radius = 6378.137; // earth mean radius defined by WGS84
        $dlon = $lon1 - $lon2;
        $distance = acos(sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($dlon))) * $radius;
        return $distance;
    }

    function getListObj(){
        $obj = new \stdClass();
        $obj->id = $this->getId();
        $obj->latitude = $this->getLatitude();
        $obj->longitude = $this->getLongitude();
        $obj->title = $this->getTitle();
        $obj->service = $this->getService()->getId();
        return $obj;
    }
    function getListObjWS(){
        $obj = new \stdClass();
        $obj->id = $this->getId();
        $obj->latitude = $this->getLatitude();
        $obj->longitude = $this->getLongitude();
        $obj->title = $this->getTitle();
        $subList =  $this->getService()->getSubcategories()->toArray();
        if(count($subList)>0)
            $obj->icon = $subList[0]->getThumb();
        $obj->service = $this->getService();
        return $obj;
    }
}