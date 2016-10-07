<?php

namespace Black\User\Infrastructure\CQRS\Handler;

use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;
use Black\User\Domain\Event\UserUpdatedEvent;
use Black\User\Infrastructure\Persistence\CQRS\WriteRepository;
use Black\User\Infrastructure\Service\UserWriteService;
use Black\User\UserDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class UpdatePasswordHandler
 */
class UpdatePasswordHandler implements CommandHandler
{
    /**
     * @var WriteRepository
     */
    protected $repository;

    /**
     * @var UserWriteService
     */
    protected $service;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * UpdatePasswordHandler constructor.
     * @param WriteRepository $userManager
     * @param UserWriteService $service
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        WriteRepository $userManager,
        UserWriteService $service,
        EventDispatcherInterface $dispatcher
    ) {
        $this->repository    = $userManager;
        $this->service    = $service;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command)
    {
        $user = $this->service->updatePassword($command->getUser(), $command->getPassword());
        $this->repository->update($user);

        $event = new UserUpdatedEvent($user);
        $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_UPDATED, $event);
    }
}
