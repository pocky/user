<?php

namespace Black\User\Infrastructure\CQRS\Command;

use Black\User\Domain\Entity\User;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;
use Email\EmailAddress;

/**
 * Class UpdateAccountCommand
 */
final class UpdateAccountCommand implements Command
{
    /**
     * @var
     */
    protected $user;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * @param User $user
     * @param $name
     * @param EmailAddress $email
     */
    public function __construct(User $user, $name, EmailAddress $email)
    {
        $this->user = $user;
        $this->name = (string) $name;
        $this->email = $email;
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
