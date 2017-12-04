<?php

namespace AppBundle\Entity\DTOs;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Type;


/**
 * @ExclusionPolicy("none")
 */
class Event
{
    /**
     * @Type("string")
     */
    private $name;

    /**
     * @Type("string")
     */
    private $description;

    /**
     * @Type("string")
     */
    private $event_url;

    /**
     * @Type("string")
     */
    private $time;

    /**
     * @Type("string")
     */
    private $updated;

    /**
     * @Type("array")
     */
    private $group;

    /**
     * @Type("integer")
     */
    private $duration;

    /**
     * @Type("integer")
     */
    private $distance;

    public function getName()
    {
        return $this->name;
    }


    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getEventUrl()
    {
        return $this->event_url;
    }

    public function setEventUrl($event_url)
    {
        $this->event_url = $event_url;
    }

    public function getTime()
    {
        return $this->time/1000;

    }

    public function setTime($time)
    {
        $this->time = $time;
    }

    public function getUpdated()
    {
        return $this->updated/1000;

    }

    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    public function getGroup()
    {
        return $this->group;

    }

    public function setGroup($group)
    {
        $this->group = $group;
    }

    public function getDuration()
    {
        return $this->duration/60000;

    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getDistance()
    {
        return $this->distance*1.60934;

    }

    public function setDistance($distance)
    {
        $this->distance = $distance;
    }
}