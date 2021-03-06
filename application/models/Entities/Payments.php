<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="payments")
 */
class Payments
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    public $id;

    /**
     *
     * @ManyToOne(targetEntity="Membership", inversedBy="payments")
     */
    public $membership;

    /**  1-evidencia 2-en linea
     * @Column(type="integer")
     * @var int
     **/
    public $type;

    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    public $evidence;

    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    public $country;

    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    public $phone;

    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    public $nombre;

    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    public $numero;

    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    public $caducidad;
    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    public $cvv;

    /**
     * 0 - esperando autorizacion (en revision),
     * 1 - autorizado,
     * 2 - vencido
     * 3 - denegado
     * @Column(type="integer")
     * @var int
     **/
    public $state;

    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    public $reason;

    /**
     *
     * @ManyToOne(targetEntity="Service", inversedBy="payments")
     */
    protected $service;

    /**
     * @Column(type="datetime")
     **/
    protected $updated_at;
    /**
     * @Column(type="datetime")
     **/
    public $created_at;

    /**
     * @Column(type="datetime",nullable=true)
     **/
    protected $payed_at;
    /**
     * @Column(type="datetime",nullable=true)
     **/
    protected $expiration_date;
    /*ESTA ES LA VARIABLE DE CONTROL PARA SABER SI EL SERVICIO ES PRO TODAVIA*/


    public function __construct()
    {
        $this->created_at = new \DateTime("now");
        $this->updated_at = new \DateTime("now");
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Get membership
     * @return \Entities\Membership
     */
    public function getMembership()
    {
        return $this->membership;
    }

    /**
     * @param \Entities\Membership $membership
     */
    public function setMembership($membership)
    {
        $this->membership = $membership;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    public function getTypeString(){
        ///**  1-evidencia 2-en linea
        switch ($this->getType()){
            case 1:
                return "Evidencia";
                break;
            default:
                return "Pago en Linea";
        }
    }

    /**
     * @param int $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getEvidence()
    {
        return $this->evidence;
    }

    /**
     * @param string $evidence
     */
    public function setEvidence($evidence)
    {
        $this->evidence = $evidence;
    }

    /**
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * @param string $evidence
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return \Entities\Service
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param \Entities\Service $service
     */
    public function setService(\Entities\Service $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }
    public function getStateString()
    {
        switch ($this->getState()){
            case 0:
                return "Esperando aprobación";
            case 1:
                return "Autorizado";
            case 2:
                return "Pago vencido";
            default:
                return "Denegado";
        }
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    public function denegar($reason = null){
        $this->setState(3);
        if ($reason)
            $this->setReason($reason);
    }


    public function autorizar($reason){
        $this->payed_at = new \DateTime("now");
        $membership = $this->getMembership();
        $days = $membership->getDays();
        $interval = new \DateInterval("P{$days}D");
        $actual = new \DateTime("now");
        $actual->add($interval);
        $this->expiration_date = $actual;
        $this->setState(1);
        if ($reason)
            $this->setReason($reason);
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return string
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * @param string $cvv
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }

    /**
     * @return string
     */
    public function getCaducidad()
    {
        return $this->caducidad;
    }

    /**
     * @param string $caducidad
     */
    public function setCaducidad($caducidad)
    {
        $this->caducidad = $caducidad;
    }

    /**
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param string $numero
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
}