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
     * @ManyToOne(targetEntity="User", inversedBy="mensajesc")
     */
    public $author;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="mensajes")
     */
    public $destinatario;
    public function __construct()
    {
        $this->services = new \Doctrine\Common\Collections\ArrayCollection();
        $this->estado = 0;
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