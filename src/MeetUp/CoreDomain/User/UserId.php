<?php

namespace MeetUp\CoreDomain\User;

class UserId
{
    private $value;

    public function __construct($value)
    {
        $this->value = (string) $value;
    }

    public function getValue()
    {
        return $this->value;
    }
}