<?php

namespace Black\User\Infrastructure\CQRS\Handler;

use Black\User\Domain\Entity\UserId;
use Black\User\Infrastructure\CQRS\Command\ActiveUserCommand;
use Black\User\Domain\Entity\UserWriteRepository;
use Black\User\Domain\Event\UserActivatedEvent;
use Black\User\Infrastructure\Service\UserStatusService;
use Black\User\UserDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class ActiveUserHandler
 */
class ActiveUserHandler implements CommandHandler
{
    /**
     * @var UserWriteRepository
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
     * @param UserWriteRepository $repository
     * @param UserStatusService $service
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        UserWriteRepository $repository,
        UserStatusService $service,
        EventDispatcherInterface $dispatcher
    ) {
        $this->repository    = $repository;
        $this->service    = $service;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param ActiveUserCommand $command
     */
    public function handle(ActiveUserCommand $command)
    {
        $user = $this->service->activate($command->getUser());
        $this->repository->flush();

        $event = new UserActivatedEvent($user);
        $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_ACTIVATED, $event);
    }
}
