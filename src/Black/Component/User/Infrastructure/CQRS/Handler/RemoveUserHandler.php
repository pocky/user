<?php

/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\User\Infrastructure\CQRS\Handler;

use Black\Component\User\Domain\Model\UserReadRepository;
use Black\Component\User\Infrastructure\CQRS\Command\RemoveUserCommand;
use Black\Component\User\Domain\Model\UserWriteRepository;
use Black\Component\User\Domain\Event\UserRemovedEvent;
use Black\Component\User\UserDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class RemoveUserHandler
 */
class RemoveUserHandler implements CommandHandler
{
    /**
     * @var UserWriteRepository
     */
    protected $repository;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @param UserWriteRepository $userManager
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        UserReadRepository $readRepository,
        UserWriteRepository $writeRepository,
        EventDispatcherInterface $dispatcher
    ) {
        $this->readRepository = $readRepository;
        $this->writeRepository = $writeRepository;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param RemoveUserCommand $command
     */
    public function handle(RemoveUserCommand $command)
    {
        $user = $this->readRepository->find($command->getUserId());

        if ($user) {
            $this->writeRepository->remove($user);
            $this->writeRepository->flush();

            $event = new UserRemovedEvent($user);
            $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_REMOVED, $event);
        }
    }
}
