<?php

namespace MeetUp\CoreDomainBundle\Repository;

use MeetUp\CoreDomain\User\User;
use MeetUp\CoreDomain\User\UserId;
use MeetUp\CoreDomain\User\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    private $users;

    public function __construct()
    {
        $this->users[] = new User(
            new UserId('AAAAAAAA-B123-C123-D123-123456789012'), 'NAME1', 'LASTNAME1'
        );
        $this->users[] = new User(
            new UserId('BBBBBBBB-C123-D123-E123-123456789012'), 'NAME2', 'LASTNAME2'
        );
    }

    public function find(UserId $userId)
    {
    }

    public function findAll()
    {
        return $this->users;
    }

    public function add(User $user)
    {
    }

    public function remove(User $user)
    {
    }
}