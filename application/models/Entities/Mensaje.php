<?php
namespace Entities;

/**
 * @Entity
 * @Table(name="mensaje")
 */
class Mensaje
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
    public $mensaje;

    /**
     * 0 - nuevo
     * 1 - notificado
     * 2 - leido
     * @Column(type="integer")
     * @var int
     **/
    public $estado;


    /**
     * @Column(type="datetime")
     **/
    protected $created_at;

    /**
     * @Column(type="datetime")
     **/
    protected $updated_at;


    /**
     * @ManyToOne(targetEntity="Service", inversedBy="mensajes")
     */
    public $service;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="mensajesc")
     */
    private $author;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="mensajes")
     */
    private $destinatario;
    public function __construct()
    {
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estado = 0;
        $this->created_at = new \DateTime("now");
        $this->updated_at = new \DateTime("now");
    }

    public function setAuthor(User $user){
        $this->author = $user;
    }
    public function setService(Service $service){
        $this->service = $service;
    }

    public function setDestinatario(User $user){
        $this->destinatario = $user;
    }

    /**
     * @return  User
     */
    public function getDestinatario(){
       return $this->destinatario;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }
    public function getMensaje()
    {
        return $this->mensaje;
    }
    public function setTitle($title)
    {
        $this->title = $title;
    }
    /**
     * Add service
     *
     * @param \Entities\Service $service
     *
     * @return City
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

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

}