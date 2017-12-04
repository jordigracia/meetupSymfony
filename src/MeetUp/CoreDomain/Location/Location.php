<?php

namespace MeetUp\CoreDomain\Event;


class Location
{
    private $city;

    private $country;

    private $localized_country_name;

    private $name_string;

    private $zip;

    private $lat;

    private $lon;

    public function getCity()
    {
        return $this->city;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getLocalizedCountryName()
    {
        return $this->localized_country_name;
    }

    public function getNameString()
    {
        return $this->name_string;
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function getLat()
    {
        return $this->lat;
    }

    public function getLon()
    {
        return $this->lon;
    }
}