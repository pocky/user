<?php

/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\User\Infrastructure\CQRS\Handler;

use Black\User\Infrastructure\CQRS\Command\CreateUserCommand;
use Black\User\Domain\Entity\UserWriteRepository;
use Black\User\Domain\Event\UserCreatedEvent;
use Black\User\Domain\Event\UserCreatedSubscriber;
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
     * @var UserWriteRepository
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
     * @param UserWriteRepository $repository
     * @param RegisterService $service
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        UserWriteRepository $repository,
        RegisterService $service,
        EventDispatcherInterface $dispatcher
    ) {
        $this->repository = $repository;
        $this->service = $service;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param CreateUserCommand $command
     */
    public function handle(CreateUserCommand $command)
    {
        $user = $this->service->create($command->getUserId(), $command->getName(), $command->getEmail());

        if ($user) {
            $this->repository->flush();

            $event = new UserCreatedEvent($user);
            $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_CREATED, $event);
        }
    }
}
