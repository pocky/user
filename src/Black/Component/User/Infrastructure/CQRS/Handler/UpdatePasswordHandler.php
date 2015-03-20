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

use Black\Component\User\Domain\Event\UserUpdatedEvent;
use Black\Component\User\Infrastructure\CQRS\Command\UpdatePasswordCommand;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\Component\User\Infrastructure\Service\UserWriteService;
use Black\Component\User\UserDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class UpdatePasswordHandler
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class UpdatePasswordHandler implements CommandHandler
{
    /**
     * @var UserManager
     */
    protected $manager;

    /**
     * @var UserWriteService
     */
    protected $service;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @param UserManager $userManager
     * @param UserWriteService $service
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        UserManager $userManager,
        UserWriteService $service,
        EventDispatcherInterface $dispatcher
    ) {
        $this->manager    = $userManager;
        $this->service    = $service;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param UpdatePasswordCommand $command
     */
    public function handle(UpdatePasswordCommand $command)
    {
        $user = $this->service->updatePassword($command->getUser(), $command->getPassword());
        $this->manager->flush();

        $event = new UserUpdatedEvent($user);
        $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_UPDATED, $event);
    }
}
