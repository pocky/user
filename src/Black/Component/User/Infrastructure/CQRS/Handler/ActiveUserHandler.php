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
use Black\Component\User\Infrastructure\CQRS\Command\ActiveUserCommand;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\Component\User\Infrastructure\DomainEvent\UserActivateEvent;
use Black\Component\User\Infrastructure\DomainEvent\UserActivateSubscriber;
use Black\Component\User\Infrastructure\Service\UserStatusService;
use Black\Component\User\UserEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class ActiveUserHandler
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class ActiveUserHandler implements CommandHandler
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
     * @var EventDispatcher
     */
    protected $dispatcher;

    /**
     * @var UserActivateSubscriber
     */
    protected $subscriber;

    /**
     * @param UserManager $userManager
     * @param UserStatusService $service
     * @param EventDispatcher $dispatcher
     * @param UserActivateSubscriber $subscriber
     */
    public function __construct(
        UserManager $userManager,
        UserStatusService $service,
        EventDispatcher $dispatcher,
        UserActivateSubscriber $subscriber
    ) {
        $this->manager    = $userManager;
        $this->service    = $service;
        $this->dispatcher = $dispatcher;
        $this->subscriber = $subscriber;
    }

    /**
     * @param ActiveUserCommand $command
     */
    public function handle(ActiveUserCommand $command)
    {
        $user = $this->service->activate(new UserId($command->getUserId()));

        if ($user) {
            $this->manager->flush();

            $event = new UserActivateEvent($user->getUserId()->getValue(), $user->getName());
            $this->dispatcher->addSubscriber($this->subscriber);
            $this->dispatcher->dispatch(UserEvents::USER_ACTIVATE, $event);
        }
    }
}
