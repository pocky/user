<?php

namespace Black\User\Infrastructure\CQRS\Command;

use Black\User\Domain\Entity\User;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;

/**
 * Class DeactiveUserCommand
 */
class DeactiveUserCommand implements Command
{
    /**
     * @var User
     */
    private $user;

    /**
     * DeactiveUserCommand constructor.
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
