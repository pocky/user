<?php

namespace Black\User\Infrastructure\CQRS\Handler;

use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;
use Black\User\Infrastructure\Persistence\CQRS\WriteRepository;
use Black\User\Domain\Event\UserCreatedEvent;
use Black\User\Infrastructure\Service\RegisterService;
use Black\User\UserDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class CreateUserHandler
 */
class CreateUserHandler implements CommandHandler
{
    /**
     * @var WriteRepository
     */
    protected $repository;

    /**
     * @var RegisterService
     */
    protected $service;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * CreateUserHandler constructor.
     * @param WriteRepository $repository
     * @param RegisterService $service
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        WriteRepository $repository,
        RegisterService $service,
        EventDispatcherInterface $dispatcher
    ) {
        $this->repository = $repository;
        $this->service = $service;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command)
    {
        $user = $this->service->create($command->getUserId(), $command->getName(), $command->getEmail());

        if ($user) {
            $this->repository->update($user);

            $event = new UserCreatedEvent($user);
            $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_CREATED, $event);
        }
    }
}
