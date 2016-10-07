<?php

namespace Black\User\Infrastructure\CQRS\Handler;

use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;
use Black\User\Infrastructure\Persistence\CQRS\WriteRepository;
use Black\User\Domain\Event\UserDeactivatedEvent;
use Black\User\Infrastructure\Service\UserStatusService;
use Black\User\UserDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class DisableUserHandler
 */
class DisableUserHandler implements CommandHandler
{
    /**
     * @var WriteRepository
     */
    protected $repository;

    /**
     * @var UserStatusService
     */
    protected $service;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @param WriteRepository $repository
     * @param UserStatusService $service
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        WriteRepository $repository,
        UserStatusService $service,
        EventDispatcherInterface $dispatcher
    ) {
        $this->repository    = $repository;
        $this->service    = $service;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command)
    {
        $user = $this->service->deactivate($command->getUser());
        $this->repository->update($user);

        $event = new UserDeactivatedEvent($user);
        $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_DEACTIVATED, $event);
    }
}
