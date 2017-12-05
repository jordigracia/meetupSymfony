<?php

namespace ApiBundle\Command;

use SimpleBus\Message\Name\NamedMessage;


class DeleteUserCommand implements NamedMessage
{
    /**
    * @var int
    */
    private $userId;

    /**
    * DeleteUserCommand constructor.
    * @param int $userId
    */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
    * @return int
    */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
    * The name of this particular type of message.
    *
    * @return string
    */
    public static function messageName()
    {
        return 'delete_user_command';
    }
}