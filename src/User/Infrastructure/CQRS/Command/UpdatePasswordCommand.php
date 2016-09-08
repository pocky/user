<?php

namespace Black\User\Infrastructure\CQRS\Command;

use Black\User\Domain\Entity\User;
use Black\User\Domain\Entity\UserId;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;

/**
 * Class UpdatePasswordCommand
 */
final class UpdatePasswordCommand implements Command
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param User   $user
     * @param string $password
     */
    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = (string) $password;
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
    public function getPassword() : string
    {
        return $this->password;
    }
}
