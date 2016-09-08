<?php

namespace Black\User\Application\Action;

use Black\User\Domain\Entity\User;
use Black\User\Infrastructure\CQRS\Handler\LockUserHandler;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;

/**
 * Class LockUser
 */
class LockUser
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
     * @param LockUserHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        LockUserHandler $handler,
        $commandName
    ) {
        $this->bus = $bus;
        $this->handler = $handler;
        $this->commandName = $commandName;
    }

    /**
     * @param User $user
     */
    public function __invoke(User $user)
    {
        $this->bus->register($this->commandName, $this->handler);
        $this->bus->handle(new $this->commandName($user));
    }
}
