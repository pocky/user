<?php

namespace Black\User\Application\Action;

use Black\User\Domain\Entity\User;
use Black\User\Infrastructure\CQRS\Handler\UpdateAccountHandler;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;
use Email\EmailAddress;

/**
 * Class UpdateAccount
 */
class UpdateAccount
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
     * @param UpdateAccountHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        UpdateAccountHandler $handler,
        $commandName
    ) {
        $this->bus = $bus;
        $this->handler = $handler;
        $this->commandName = $commandName;
    }

    /**
     * @param User $user
     * @param $name
     * @param EmailAddress $email
     */
    public function __invoke(User $user, $name, EmailAddress $email)
    {
        $this->bus->register($this->commandName, $this->handler);
        $this->bus->handle(new $this->commandName($user, $name, $email));
    }
}
