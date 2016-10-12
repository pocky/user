<?php

namespace Black\User\Domain\Event;

use Black\User\Domain\Entity\User;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class UserActivatedEvent
 */
class UserActivatedEvent extends Event
{
    /**
     * @var
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser() : User
    {
        return $this->user;
    }

    /**
     * @return string
     */
    public function message() : string
    {
        return "The user {$this->user->getUsername()} ({$this->user->getUserId()}) is now activated.";
    }
}
