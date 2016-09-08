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

use Black\User\Infrastructure\CQRS\Command\UpdateAccountCommand;
use Black\User\Domain\Entity\UserWriteRepository;
use Black\User\Domain\Event\UserUpdatedEvent;
use Black\User\Infrastructure\Service\RegisterService;
use Black\User\Infrastructure\Service\UserWriteService;
use Black\User\UserDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class UpdateAccountHandler
 */
class UpdateAccountHandler implements CommandHandler
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
     * @param UserWriteService $service
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        UserWriteRepository $repository,
        UserWriteService $service,
        EventDispatcherInterface $dispatcher
    ) {
        $this->repository    = $repository;
        $this->service    = $service;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param UpdateAccountCommand $command
     */
    public function handle(UpdateAccountCommand $command)
    {
        $user = $this->service->updateAccount($command->getUser(), $command->getName(), $command->getEmail());
        $this->repository->flush();

        $event = new UserUpdatedEvent($user);
        $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_UPDATED, $event);
    }
}
