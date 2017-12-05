<?php

namespace ApiBundle\Command\Handler;

use ApiBundle\Command\DeleteUserCommand;
use MeetUp\CoreDomain\User\UserRepository;
use Doctrine\ORM\EntityManager;

class DeleteUserHandler
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * DeleteUserHandler constructor.
     * @param EntityManager $entityManager
     * @param UserRepository $repository
     */
    public function __construct(
        EntityManager $entityManager,
        UserRepository $repository
    )
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }

    /**
     * @param DeleteUserCommand $command
     */
    public function handle(DeleteUserCommand $command)
    {
        $user = $this->repository->findOneBy(['id' => $command->getUserId()]);
        $this->entityManager->remove($user);
    }
}