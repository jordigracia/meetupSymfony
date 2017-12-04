<?php

namespace MeetUp\CoreDomain\Event;


class Event
{
    private $name;

    private $description;

    private $event_url;

    private $time;

    private $updated;

    private $group;

    private $duration;

    private $distance;


    public function __construct($name, $description, $event_url, $time, $updated, $group, $duration, $distance)
    {
        $this->name         =   $name;
        $this->description  =   $description;
        $this->event_url    =   $event_url;
        $this->time         =   $time;
        $this->updated      =   $updated;
        $this->group        =   $group;
        $this->duration     =   $duration;
        $this->distance     =   $distance;
    }

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