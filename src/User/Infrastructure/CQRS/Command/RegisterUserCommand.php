<?php

namespace Black\User\Infrastructure\CQRS\Command;

use Black\User\Domain\Entity\UserId;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;
use Email\EmailAddress;

/**
 * Class RegisterUserCommand
 */
final class RegisterUserCommand implements Command
{
    /**
     * @var UserId
     */
    protected $userId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param UserId $userId
     * @param $name
     * @param EmailAddress $email
     * @param $password
     */
    public function __construct(UserId $userId, $name, EmailAddress $email, $password)
    {
        $this->userId = $userId;
        $this->name = (string) $name;
        $this->email = $email;
        $this->password = (string) $password;
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
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return EmailAddress
     */
    public function getEmail() : EmailAddress
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }
}
