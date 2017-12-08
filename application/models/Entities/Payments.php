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
    protected $membership;

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
     * 0 - esperando autorizacion (en revision),
     * 1 - autorizado,
     * 2 - vencido
     * 3 - denegado
     * @Column(type="integer")
     * @var int
     **/
    public $state;

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
    protected $created_at;

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

    public function denegar(){
        $this->setState(3);
    }
    public function autorizar(){
        $this->payed_at = new \DateTime("now");
        $membership = $this->getMembership();
        $days = $membership->getDays();
        $interval = new \DateInterval("P{$days}D");
        $actual = new \DateTime("now");
        $actual->add($interval);
        $this->expiration_date = $actual;
        $this->setState(1);
    }
}