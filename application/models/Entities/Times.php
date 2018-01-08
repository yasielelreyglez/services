<?php
/**
 * Created by PhpStorm.
 * User: saul
 * Date: 1/7/2018
 * Time: 12:52 AM
 */

namespace Entities;

/**
 * @Entity
 * @Table(name="times")
 */
class Times
{

    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     **/
    public $id;
    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    public $week_days;

    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    public $start_time;

    /**
     * @Column(type="string",nullable=true)
     * @var string
     **/
    public $end_time;

    /**
     *
     * @ManyToOne(targetEntity="Service", inversedBy="times")
     */
    protected $service;

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

    /**
     * @return string
     */
    public function getWeekDays()
    {
        return $this->week_days;
    }

    /**
     * @param string $week_days
     */
    public function setWeekDays($week_days)
    {
        $this->week_days = $week_days;
    }

    /**
     * @return string
     */
    public function getStartTime()
    {
        return $this->start_time;
    }

    /**
     * @param string $start_time
     */
    public function setStartTime($start_time)
    {
        $this->start_time = $start_time;
    }

    /**
     * @return string
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * @param string $end_time
     */
    public function setEndTime($end_time)
    {
        $this->end_time = $end_time;
    }
}