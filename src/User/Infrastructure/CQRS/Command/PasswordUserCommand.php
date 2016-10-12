<?php

namespace Black\User\Infrastructure\CQRS\Command;

use Black\User\Domain\ValueObject\UserId;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;

/**
 * Class PasswordUserCommand
 */
final class PasswordUserCommand implements Command
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $passwordConfirm;

    /**
     * @param UserId $userId
     * @param $password
     * @param $passwordConfirm
     */
    public function __construct(UserId $userId, $password, $passwordConfirm)
    {
        $this->userId = $userId;
        $this->password = (string) $password;
        $this->passwordConfirm = (string) $passwordConfirm;
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
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getPasswordConfirmation() : string
    {
        return $this->passwordConfirm;
    }
}
