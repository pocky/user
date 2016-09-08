<?php

namespace Black\User\Application\Action;

use Black\User\Domain\Entity\User;
use Black\User\Infrastructure\CQRS\Handler\ActiveUserHandler;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;

/**
 * Class ActiveUser
 */
class ActiveUser
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
     * @param ActiveUserHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        ActiveUserHandler $handler,
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
