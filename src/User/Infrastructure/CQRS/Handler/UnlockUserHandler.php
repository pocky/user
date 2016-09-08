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

use Black\User\Domain\Event\UserUnlockedEvent;
use Black\User\Infrastructure\CQRS\Command\UnlockUserCommand;
use Black\User\Domain\Entity\UserWriteRepository;
use Black\User\Infrastructure\Service\UserStatusService;
use Black\User\UserDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class UnlockUserHandler
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class UnlockUserHandler implements CommandHandler
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
        $this->repository = $repository;
        $this->service    = $service;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param UnlockUserCommand $command
     */
    public function handle(UnlockUserCommand $command)
    {
        $user = $this->service->unlock($command->getUser());
        $this->repository->flush();

        $event = new UserUnlockedEvent($user);
        $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_UNLOCKED, $event);
    }
}
