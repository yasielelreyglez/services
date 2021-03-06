<?php

namespace Proxies\__CG__\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class User extends \Entities\User implements \Doctrine\ORM\Proxy\Proxy
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
    public static $lazyPropertiesDefaults = ['username' => NULL, 'name' => NULL, 'email' => NULL, 'phone_id' => NULL, 'phone_so' => NULL];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {
        unset($this->username, $this->name, $this->email, $this->phone_id, $this->phone_so);

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
            return ['__isInitialized__', 'id', 'username', 'name', 'email', 'password', 'ip_address', 'phone_id', 'phone_so', 'remember_code', 'salt', 'created_on', 'last_login', 'is_facebook', 'active', 'role', '' . "\0" . 'Entities\\User' . "\0" . 'userservices', '' . "\0" . 'Entities\\User' . "\0" . 'mensajesc', '' . "\0" . 'Entities\\User' . "\0" . 'mensajes', '' . "\0" . 'Entities\\User' . "\0" . 'usercomments', '' . "\0" . 'Entities\\User' . "\0" . 'reportcomments', 'forgotten_password_code', 'forgotten_password_time', 'services'];
        }

        return ['__isInitialized__', 'id', 'password', 'ip_address', 'remember_code', 'salt', 'created_on', 'last_login', 'is_facebook', 'active', 'role', '' . "\0" . 'Entities\\User' . "\0" . 'userservices', '' . "\0" . 'Entities\\User' . "\0" . 'mensajesc', '' . "\0" . 'Entities\\User' . "\0" . 'mensajes', '' . "\0" . 'Entities\\User' . "\0" . 'usercomments', '' . "\0" . 'Entities\\User' . "\0" . 'reportcomments', 'forgotten_password_code', 'forgotten_password_time', 'services'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (User $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

            unset($this->username, $this->name, $this->email, $this->phone_id, $this->phone_so);
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
    public function getUsername()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsername', []);

        return parent::getUsername();
    }

    /**
     * {@inheritDoc}
     */
    public function setUsername($username)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUsername', [$username]);

        return parent::setUsername($username);
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
    public function getIp()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIp', []);

        return parent::getIp();
    }

    /**
     * {@inheritDoc}
     */
    public function setIp($ip)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIp', [$ip]);

        return parent::setIp($ip);
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPassword', []);

        return parent::getPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword($password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPassword', [$password]);

        return parent::setPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function getRole()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRole', []);

        return parent::getRole();
    }

    /**
     * {@inheritDoc}
     */
    public function setRole($role)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRole', [$role]);

        return parent::setRole($role);
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
    public function addUserservice(\Entities\UserService $userservice)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addUserservice', [$userservice]);

        return parent::addUserservice($userservice);
    }

    /**
     * {@inheritDoc}
     */
    public function removeUserservice(\Entities\UserService $userservice)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeUserservice', [$userservice]);

        return parent::removeUserservice($userservice);
    }

    /**
     * {@inheritDoc}
     */
    public function getUserservices()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUserservices', []);

        return parent::getUserservices();
    }

    /**
     * {@inheritDoc}
     */
    public function addUsercomment(\Entities\Comments $usercomment)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addUsercomment', [$usercomment]);

        return parent::addUsercomment($usercomment);
    }

    /**
     * {@inheritDoc}
     */
    public function removeUsercomment(\Entities\Comments $usercomment)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeUsercomment', [$usercomment]);

        return parent::removeUsercomment($usercomment);
    }

    /**
     * {@inheritDoc}
     */
    public function getUsercomments()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUsercomments', []);

        return parent::getUsercomments();
    }

    /**
     * {@inheritDoc}
     */
    public function addService(\Entities\Service $service)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addService', [$service]);

        return parent::addService($service);
    }

    /**
     * {@inheritDoc}
     */
    public function removeService(\Entities\Service $service)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeService', [$service]);

        return parent::removeService($service);
    }

    /**
     * {@inheritDoc}
     */
    public function getServices()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getServices', []);

        return parent::getServices();
    }

    /**
     * {@inheritDoc}
     */
    public function getReportcomments()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReportcomments', []);

        return parent::getReportcomments();
    }

    /**
     * {@inheritDoc}
     */
    public function setReportcomments($reportcomments)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReportcomments', [$reportcomments]);

        return parent::setReportcomments($reportcomments);
    }

    /**
     * {@inheritDoc}
     */
    public function getMensajes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMensajes', []);

        return parent::getMensajes();
    }

    /**
     * {@inheritDoc}
     */
    public function setMensajes($mensajes)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMensajes', [$mensajes]);

        return parent::setMensajes($mensajes);
    }

    /**
     * {@inheritDoc}
     */
    public function addMensaje(\Entities\Mensaje $mensaje)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addMensaje', [$mensaje]);

        return parent::addMensaje($mensaje);
    }

    /**
     * {@inheritDoc}
     */
    public function addMensajeCreado(\Entities\Mensaje $mensaje)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addMensajeCreado', [$mensaje]);

        return parent::addMensajeCreado($mensaje);
    }

    /**
     * {@inheritDoc}
     */
    public function notificarComentario(\Entities\Service $servicio)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'notificarComentario', [$servicio]);

        return parent::notificarComentario($servicio);
    }

    /**
     * {@inheritDoc}
     */
    public function notificarDenuncia(\Entities\Service $servicio)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'notificarDenuncia', [$servicio]);

        return parent::notificarDenuncia($servicio);
    }

    /**
     * {@inheritDoc}
     */
    public function notificarBloqueo(\Entities\Service $servicio)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'notificarBloqueo', [$servicio]);

        return parent::notificarBloqueo($servicio);
    }

    /**
     * {@inheritDoc}
     */
    public function notificarPagoAceptado(\Entities\Service $servicio, $reason)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'notificarPagoAceptado', [$servicio, $reason]);

        return parent::notificarPagoAceptado($servicio, $reason);
    }

    /**
     * {@inheritDoc}
     */
    public function sendMessageTo(\Entities\User $destinatario, \Entities\Service $servicio, $titulo = 'title', $cuerpo = '')
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'sendMessageTo', [$destinatario, $servicio, $titulo, $cuerpo]);

        return parent::sendMessageTo($destinatario, $servicio, $titulo, $cuerpo);
    }

    /**
     * {@inheritDoc}
     */
    public function getPhoneId()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPhoneId', []);

        return parent::getPhoneId();
    }

    /**
     * {@inheritDoc}
     */
    public function setPhoneId($phone_id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPhoneId', [$phone_id]);

        return parent::setPhoneId($phone_id);
    }

    /**
     * {@inheritDoc}
     */
    public function getPhoneSo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPhoneSo', []);

        return parent::getPhoneSo();
    }

    /**
     * {@inheritDoc}
     */
    public function setPhoneSo($phone_so)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPhoneSo', [$phone_so]);

        return parent::setPhoneSo($phone_so);
    }

    /**
     * {@inheritDoc}
     */
    public function getisFacebook()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getisFacebook', []);

        return parent::getisFacebook();
    }

    /**
     * {@inheritDoc}
     */
    public function setIsFacebook($is_facebook)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIsFacebook', [$is_facebook]);

        return parent::setIsFacebook($is_facebook);
    }

}
