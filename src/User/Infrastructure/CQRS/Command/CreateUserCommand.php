<?php

namespace Black\User\Infrastructure\CQRS\Command;

use Black\User\Domain\Entity\UserId;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;
use Email\EmailAddress;
use Symfony\Component\Validator\Constraints\Email;

/**
 * Class CreateUserCommand
 */
final class CreateUserCommand implements Command
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
     * @param UserId $userId
     * @param $name
     * @param EmailAddress $email
     */
    public function __construct(UserId $userId, $name, EmailAddress $email)
    {
        $this->userId = $userId;
        $this->name = (string) $name;
        $this->email = $email;
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
}
