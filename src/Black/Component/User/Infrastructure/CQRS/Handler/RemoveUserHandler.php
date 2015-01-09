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

use Black\Component\User\Infrastructure\CQRS\Command\RemoveUserCommand;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\Component\User\Domain\Event\UserRemovedEvent;
use Black\Component\User\Domain\Event\UserRemovedSubscriber;
use Black\Component\User\UserDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class RemoveUserHandler
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class RemoveUserHandler implements CommandHandler
{
    /**
     * @var UserManager
     */
    protected $manager;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @param UserManager $userManager
     */
    public function __construct(
        UserManager $userManager,
        EventDispatcherInterface $dispatcher
    ) {
        $this->manager = $userManager;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param RemoveUserCommand $command
     */
    public function handle(RemoveUserCommand $command)
    {
        $user = $this->manager->find($command->getUserId());

        if ($user) {
            $this->manager->remove($user);
            $this->manager->flush();

            $event = new UserRemovedEvent($user->getUserId()->getValue(), $user->getName());
            $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_REMOVED, $event);
        }
    }
}
