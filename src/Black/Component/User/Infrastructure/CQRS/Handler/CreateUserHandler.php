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

use Black\Component\User\Infrastructure\CQRS\Command\CreateUserCommand;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\Component\User\Domain\Event\UserCreatedEvent;
use Black\Component\User\Domain\Event\UserCreatedSubscriber;
use Black\Component\User\Infrastructure\Service\RegisterService;
use Black\Component\User\UserDomainEvents;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class CreateUserHandler
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class CreateUserHandler implements CommandHandler
{
    /**
     * @var UserManager
     */
    protected $manager;

    /**
     * @var RegisterService
     */
    protected $service;

    /**
     * @var EventDispatcherInterface
     */
    protected $dispatcher;

    /**
     * @param UserManager $manager
     * @param RegisterService $service
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(
        UserManager $manager,
        RegisterService $service,
        EventDispatcherInterface $dispatcher
    ) {
        $this->manager = $manager;
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
            $this->manager->flush();

            $event = new UserCreatedEvent($user->getUserId(), $user->getName(), $user->getEmail());
            $this->dispatcher->dispatch(UserDomainEvents::USER_DOMAIN_CREATED, $event);
        }
    }
}
