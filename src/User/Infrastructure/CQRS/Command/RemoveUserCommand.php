<?php

namespace Black\User\Infrastructure\CQRS\Command;

use Black\User\Domain\Entity\UserId;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;

/**
 * Class RemoveUserCommand
 */
final class RemoveUserCommand implements Command
{
    /**
     * @var UserId
     */
    protected $userId;

    /**
     * @param UserId $userId
     */
    public function __construct(UserId $userId)
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
}
