<?php
namespace Entities;
use Send_notification;

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
    public $id;

    /**
     * @Column(type="string")
     * @var string
     **/
    public $username;

    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    public $name;
    /**
     * @Column(type="string")
     * @var string
     **/
    public $email;

    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    protected $password;

    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    protected $ip_address;

    //id del telefono del cliente
    /**
     * @Column(type="string")
     * @var string
     **/
    public $phone_id;

    //sistema operativo del telefono
    /**
     * @Column(type="string")
     * @var string
     **/
    public $phone_so;

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
    protected $is_facebook;

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
     * @OneToMany(targetEntity="Mensaje", mappedBy="author",cascade={"persist"})
     */
    private $mensajesc;

    /**
     * One User has Many UserService.
     * @OneToMany(targetEntity="Mensaje", mappedBy="destinatario",cascade={"persist"})
	 * @OrderBy({"id" = "DESC"})
     */
    private $mensajes;

    /**
     * One User has Many UserService.
     * @OneToMany(targetEntity="Comments", mappedBy="user")
     */
    private $usercomments;

    /**
     * One User has Many UserService.
     * @OneToMany(targetEntity="Comments", mappedBy="reportuser")
     */
    private $reportcomments;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $forgotten_password_code;

    /**
     * @Column(type="string")
     * @var string
     **/
    protected $forgotten_password_time;


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
        $this->created_on = new \DateTime("now");
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
 public function getIp()
    {
        return $this->ip_address;
    }

    public function setIp($ip)
    {
        $this->ip_address = $ip;
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
	public function getName()
    {
        return $this->name;
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

    /**
     * @return mixed
     */
    public function getReportcomments()
    {
        return $this->reportcomments;
    }

    /**
     * @param mixed $reportcomments
     */
    public function setReportcomments($reportcomments)
    {
        $this->reportcomments = $reportcomments;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMensajes()
    {
        return $this->mensajes;
    }

    /**
     * @param Mensaje $mensajes
     */
    public function setMensajes($mensajes)
    {
        $this->mensajes = $mensajes;
    }
    /**
     * Add $mensaje
     *
     * @param \Entities\Mensaje $mensaje
     *
     * @return User
     */
    public function addMensaje(\Entities\Mensaje $mensaje)
    {
        $this->mensajes[] = $mensaje;

        return $this;
    }

    /**
     * Add $mensaje
     *
     * @param \Entities\Mensaje $mensaje
     *
     * @return User
     */
    public function addMensajeCreado(\Entities\Mensaje $mensaje)
    {
        $this->mensajesc[] = $mensaje;

        return $this;
    }

    /**
     * @param Service $servicio
     * @return Mensaje
     */
    public function notificarComentario(Service $servicio){

        return $this->sendMessageTo($this,$servicio,"Comentario recibido","Se realizo un comentario sobre su servicio {$servicio->getTitle()}");
    }

    /**
     * @param Service $servicio
     * @return Mensaje
     */
    public function notificarDenuncia(Service $servicio){
        return $this->sendMessageTo($this,$servicio,"Denuncia recibida","Se realizó una denuncia sobre su servicio {$servicio->getTitle()}");
    }
    /**
     * @param Service $servicio
     * @return Mensaje
     */
    public function notificarDenunciante(Service $servicio){
        return $this->sendMessageTo($this,$servicio,"Denuncia Enviada","Usted realizó una denuncia sobre el servicio {$servicio->getTitle()}");
    }
    /**
     * @param Service $servicio
     * @return Mensaje
     */
    public function notificarBloqueo(Service $servicio){
        return $this->sendMessageTo($this,$servicio,"Servicio bloqueado","Ha sido bloqueado su servicio {$servicio->getTitle()}");
    }
    /**
     * @param Service $servicio
     * @return Mensaje
     */
    public function notificarPagoAceptado(Service $servicio,$reason){
        $motivo = "";
        if(isset($reason)){
            $motivo = $reason;
        }
        return $this->sendMessageTo($this,$servicio,"Pago aceptado","Ha sido aceptado el pago sobre el servicio {$servicio->getTitle()}");
        // return $this->sendMessageTo($this,$servicio,"Pago aceptado","Ha sido aceptado el pago sobre el servicio {$servicio->getTitle()}".$motivo);
    }
    /**
     * @param Service $servicio
     * @return Mensaje
     */
    public function notificarPagoDenegado(Service $servicio,$reason){
        $motivo = "";
        if(isset($reason)){
            $motivo = $reason;
        }
        return $this->sendMessageTo($this,$servicio,"Pago denegado","Ha sido denegado el pago sobre el servicio {$servicio->getTitle()}");
        // return $this->sendMessageTo($this,$servicio,"Pago denegado","El pago sobre el anuncio {$servicio->getTitle()} ha sido denegado,".$motivo);
    }
    /**
     * @param User $destinatario
     * @param String $titulo
     * @param String $cuerpo
     * @return Mensaje
     */
    public function sendMessageTo(User $destinatario,Service $servicio,$titulo="title",$cuerpo=""){
        $mensaje = new Mensaje();
        $mensaje->setAuthor($this);
        $mensaje->setDestinatario($destinatario);
        $mensaje->setTitle($titulo);
        $mensaje->setService($servicio);
        $mensaje->mensaje=$cuerpo;
        $this->addMensajeCreado($mensaje);
               //pushing notification
        //@todo Ver como cargar send notification
         return $mensaje;
    }

    /**
     * @return string
     */
    public function getPhoneId()
    {
        return $this->phone_id;
    }

    /**
     * @param string $phone_id
     */
    public function setPhoneId($phone_id)
    {
        $this->phone_id = $phone_id;
    }

    /**
     * @return string
     */
    public function getPhoneSo()
    {
        return $this->phone_so;
    }

    /**
     * @param string $phone_so
     */
    public function setPhoneSo($phone_so)
    {
        $this->phone_so = $phone_so;
    }

    /**
     * @return int
     */
    public function getisFacebook()
    {
        return $this->is_facebook;
    }

    /**
     * @param int $is_facebook
     */
    public function setIsFacebook($is_facebook)
    {
        $this->is_facebook = $is_facebook;
    }

}
