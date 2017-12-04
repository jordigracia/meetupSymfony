<?php

namespace AppBundle\Entity\DTOs;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Type;


/**
 * @ExclusionPolicy("none")
 */
class Location
{
    /**
     * @Type("string")
     */
    private $city;

    /**
     * @Type("string")
     */
    private $country;

    /**
     * @Type("string")
     */
    private $localized_country_name;

    /**
     * @Type("string")
     */
    private $name_string;

    /**
     * @Type("string")
     */
    private $zip;

    /**
     * @Type("string")
     */
    private $lat;

    /**
     * @Type("string")
     */
    private $lon;

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
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