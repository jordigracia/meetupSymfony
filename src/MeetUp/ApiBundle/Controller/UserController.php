<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ApiBundle\Command\DeleteUserCommand;

use SimpleBus\Message\Bus\MessageBus;
use Symfony\Component\HttpFoundation\Request;



class UserController extends Controller
{
    /**
     * @var MessageBus
     */
    private $messageBus;
    /**
     * UserController constructor.
     * @param MessageBus $messageBus
     */
    public function __construct(
        MessageBus $messageBus
    )
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @Rest\View
     */
    public function allUsersAction()
    {
        $users = $this->get('user_repository')->findAll();

        return array('users' => $users);
    }

    /**
     *
     * @Rest\View
     */
    public function deleteUserAction(Request $request)
    {
        $userId = $request->get('id');
        $command = new DeleteUserCommand($userId);
        $this->messageBus->handle($command);

        return 'User with'.$userId.'deleted';
    }
}