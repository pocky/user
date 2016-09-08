<?php

namespace Black\User\Infrastructure\CQRS\Command;

use Black\User\Domain\Entity\User;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;

/**
 * Class UnlockUserCommand
 */
class UnlockUserCommand implements Command
{
    /**
     * @var User
     */
    protected $user;

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
}
