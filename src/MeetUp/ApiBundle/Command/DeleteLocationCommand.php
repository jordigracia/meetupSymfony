<?php

namespace ApiBundle\Command;

use SimpleBus\Message\Name\NamedMessage;


class DeleteLocationCommand implements NamedMessage
{
    /**
     * @var string
     */
    private $zip;

    /**
     * @param string $zip
     */
    public function __construct($zip)
    {
        $this->zip = $zip;
    }

    /**
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     *
     * @return string
     */
    public static function messageName()
    {
        return 'delete_location_command';
    }
}