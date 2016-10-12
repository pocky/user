<?php

namespace Black\User\Domain\Event;

use Black\User\Domain\Entity\User;
use Black\User\Domain\ValueObject\UserId;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class UserNotFoundEvent
 */
class UserNotFoundEvent extends Event
{
    /**
     * @var
     */
    private $userId;

    /**
     * UserNotFoundEvent constructor.
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return UserId
     */
    public function getUserId() : UserId
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function message() : string
    {
        return "The user with UserId {$this->userId} was not found!.";
    }
}
