<?php

namespace Black\User\Application\Action;

use Black\User\Domain\Entity\UserId;
use Black\User\Infrastructure\CQRS\Handler\CreateUserHandler;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;
use Email\EmailAddress;

/**
 * Class CreateUser
 */
class CreateUser
{
    /**
     * @var
     */
    protected $bus;

    /**
     * @var
     */
    protected $handler;

    /**
     * @var
     */
    protected $commandName;

    /**
     * @param Bus $bus
     * @param CreateUserHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        CreateUserHandler $handler,
        $commandName
    ) {
        $this->bus = $bus;
        $this->handler = $handler;
        $this->commandName = $commandName;
    }

    /**
     * @param UserId $id
     * @param $name
     * @param EmailAddress $email
     */
    public function __invoke(UserId $id, $name, EmailAddress $email)
    {
        $this->bus->register($this->commandName, $this->handler);
        $this->bus->handle(new $this->commandName($id, $name, $email));
    }
}
