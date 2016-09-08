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

use Black\User\Domain\Event\UserLockedEvent;
use Black\User\Domain\Entity\UserId;
use Black\User\Infrastructure\CQRS\Command\ConnectUserCommand;
use Black\User\Domain\Entity\UserWriteRepository;
use Black\User\Infrastructure\Service\UserStatusService;
use Black\User\UserDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class ConnectUserHandler
 */
class ConnectUserHandler implements CommandHandler
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
     * @param ConnectUserCommand $command
     */
    public function handle(ConnectUserCommand $command)
    {
        $user = $this->service->connect($command->getUser());

        if ($user) {
            $this->repository->flush();

            $event = new UserLockedEvent($user);
            $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_LOGGED, $event);
        }
    }
}
