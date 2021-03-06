<?php

namespace MeetUp\CoreDomain\User;

interface UserRepository
{
    public function find(UserId $userId);

    public function findAll();

    public function add(User $user);

    public function remove(User $user);
}