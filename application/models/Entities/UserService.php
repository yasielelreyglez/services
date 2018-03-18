<?php
/**
 * Created by PhpStorm.
 * User: saul
 * Date: 11/2/2017
 * Time: 4:48 PM
 */
//service_user
namespace Entities;

/**
 * @Entity
 * @Table(name="service_user")
 */
class UserService
{
    /**
    * Many Features have One Product.
    * @Id @ManyToOne(targetEntity="User", inversedBy="userservices")
     */
    private $user;

    /**
     * Many Features have One Product.
     * @Id @ManyToOne(targetEntity="Service", inversedBy="serviceusers",cascade={"persist", "remove"})
     */
    private $service;

    /**
     * @Column(type="integer", nullable=true)
     * @var int
     **/
    public $favorite;

    /**
     * @Column(type="integer", nullable=true)
     * @var int
     **/
    public $rate;
    /**
     * @Column(type="string", nullable=true)
     * @var string
     **/
    public $ratecomment;

    /**
     * @Column(type="integer", nullable=true)
     * @var int
     **/
    public $contacted;
    /**
     * @Column(type="integer", nullable=true)
     * @var int
     **/
    public $visited;

    /**
     * @Column(type="datetime", nullable=true)
     **/
    public $visited_at;

    /**
     * @Column(type="string", nullable=true)
     * @var string
     **/
    public $complaint;

    /**
     * @Column(type="datetime", nullable=true)
     **/
    public $complaint_created;
    /**
     * Set favorite
     *
     * @param integer $favorite
     *
     * @return UserService
     */
    public function setFavorite($favorite)
    {
        $this->favorite = $favorite;

        return $this;
    }

    /**
     * Get favorite
     *
     * @return integer
     */
    public function getFavorite()
    {
        return $this->favorite;
    }

    /**
     * Set rate
     *
     * @param integer $rate
     *
     * @return UserService
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return integer
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set contacted
     *
     * @param integer $contacted
     *
     * @return UserService
     */
    public function setContacted($contacted)
    {
        $this->contacted = $contacted;

        return $this;
    }

    /**
     * Get contacted
     *
     * @return integer
     */
    public function getContacted()
    {
        return $this->contacted;
    }

    /**
     * Set complaint
     *
     * @param string $complaint
     *
     * @return UserService
     */
    public function setComplaint($complaint)
    {
        $this->complaint = $complaint;

        return $this;
    }


    /**
     * Get visited
     *
     * @return integer
     */
    public function getVisited()
    {
        return $this->visited;
    }

    /**
     * Set visited
     *
     * @param integer $visited
     *
     * @return UserService
     */
    public function setVisited($visited)
    {
        $this->visited = $visited;

        return $this;
    }

    /**
     * Get complaint
     *
     * @return string
     */
    public function getComplaint()
    {
        return $this->complaint;
    }

    /**
     * Set complaintCreated
     *
     * @param \DateTime $complaintCreated
     *
     * @return UserService
     */
    public function setComplaintCreated($complaintCreated)
    {
        $this->complaint_created = $complaintCreated;

        return $this;
    }

    /**
     * Get complaintCreated
     *
     * @return \DateTime
     */
    public function getComplaintCreated()
    {
        return $this->complaint_created;
    }

    /**
     * Set user
     *
     * @param \Entities\User $user
     *
     * @return UserService
     */
    public function setUser(\Entities\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Entities\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set service
     *
     * @param \Entities\Service $service
     *
     * @return UserService
     */
    public function setService(\Entities\Service $service)
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

    /**
     * @return mixed
     */
    public function getVisitedAt()
    {
        return $this->visited_at;
    }

    /**
     * @param mixed $visited_at
     */
    public function setVisitedAt($visited_at)
    {
        $this->visited_at = $visited_at;
    }

    /**
     * @return string
     */
    public function getRatecomment()
    {
        return $this->ratecomment;
    }

    /**
     * @param string $ratecomment
     */
    public function setRatecomment($ratecomment)
    {
        $this->ratecomment = $ratecomment;
    }
}