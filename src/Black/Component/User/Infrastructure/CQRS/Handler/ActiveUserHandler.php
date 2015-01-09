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
use Black\Component\User\Domain\Event\UserActivatedEvent;
use Black\Component\User\Infrastructure\Service\UserStatusService;
use Black\Component\User\UserDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

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
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @param UserManager $userManager
     * @param UserStatusService $service
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        UserManager $userManager,
        UserStatusService $service,
        EventDispatcherInterface $dispatcher
    ) {
        $this->manager    = $userManager;
        $this->service    = $service;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param ActiveUserCommand $command
     */
    public function handle(ActiveUserCommand $command)
    {
        $user = $this->service->activate(new UserId($command->getUserId()));

        if ($user) {
            $this->manager->flush();

            $event = new UserActivatedEvent($user->getUserId()->getValue(), $user->getName());
            $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_ACTIVATED, $event);
        }
    }
}
