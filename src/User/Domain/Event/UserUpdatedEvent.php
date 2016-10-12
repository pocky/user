<?php

namespace Black\User\Domain\Event;

use Black\User\Domain\Entity\User;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class UserUpdatedEvent
 */
class UserUpdatedEvent extends Event
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
        return "The user {$this->user->getUsername()} ({$this->user->getEmail()}) with {$this->user->getUserId()} identifier is updated.";
    }
}
