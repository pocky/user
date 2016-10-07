<?php

namespace Black\User\Infrastructure\CQRS\Handler;

use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;
use Black\User\Infrastructure\Persistence\CQRS\ReadRepository;
use Black\User\Infrastructure\Persistence\CQRS\WriteRepository;
use Black\User\Domain\Event\UserRemovedEvent;
use Black\User\UserDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class RemoveUserHandler
 */
class RemoveUserHandler implements CommandHandler
{
    /**
     * @var WriteRepository
     */
    protected $repository;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * RemoveUserHandler constructor.
     * @param ReadRepository $readRepository
     * @param WriteRepository $writeRepository
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        ReadRepository $readRepository,
        WriteRepository $writeRepository,
        EventDispatcherInterface $dispatcher
    ) {
        $this->readRepository = $readRepository;
        $this->writeRepository = $writeRepository;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command)
    {
        $user = $this->readRepository->find($command->getUserId());

        if ($user) {
            $this->writeRepository->remove($user);

            $event = new UserRemovedEvent($user);
            $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_REMOVED, $event);
        }
    }
}
