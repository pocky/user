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

use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\CQRS\Command\DeactiveUserCommand;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\Component\User\Domain\Event\UserDeactivatedEvent;
use Black\Component\User\Infrastructure\Service\UserStatusService;
use Black\Component\User\UserDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class DeactiveUserHandler
 */
class DeactiveUserHandler implements CommandHandler
{
    /**
     * @var UserManager
     */
    protected $manager;

    /**
     * @var UserStatusService
     */
    protected $service;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @param UserManager $manager
     * @param UserStatusService $service
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        UserManager $manager,
        UserStatusService $service,
        EventDispatcherInterface $dispatcher
    ) {
        $this->manager    = $manager;
        $this->service    = $service;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param DeactiveUserCommand $command
     */
    public function handle(DeactiveUserCommand $command)
    {
        $user = $this->service->deactivate(new UserId($command->getUserId()));

        if ($user) {
            $this->manager->flush();

            $event = new UserDeactivatedEvent($user);
            $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_DEACTIVATED, $event);
        }
    }
}
