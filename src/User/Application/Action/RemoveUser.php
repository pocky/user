<?php

namespace Black\User\Application\Action;

use Black\User\Domain\Entity\UserId;
use Black\User\Infrastructure\CQRS\Handler\RemoveUserHandler;
use Black\User\Infrastructure\Service\UserReadService;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;

/**
 * Class RemoveUser
 */
class RemoveUser
{
    /**
     * @var Bus
     */
    protected $bus;

    /**
     * @var RemoveUserHandler
     */
    protected $handler;

    /**
     * @var
     */
    protected $commandName;

    /**
     * @param Bus $bus
     * @param RemoveUserHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        RemoveUserHandler $handler,
        $commandName
    ) {
        $this->bus = $bus;
        $this->handler = $handler;
        $this->commandName = $commandName;
    }

    /**
     * @param UserId $id
     */
    public function __invoke(UserId $id)
    {
        $this->bus->register($this->commandName, $this->handler);
        $this->bus->handle(new $this->commandName($id));
    }
}
