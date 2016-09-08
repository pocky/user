<?php

namespace spec\Black\User\Infrastructure\CQRS\Handler;

use Black\User\Domain\Event\UserLockedEvent;
use Black\User\Domain\Entity\User;
use Black\User\Infrastructure\CQRS\Command\LockUserCommand;
use Black\User\Domain\Entity\UserWriteRepository;
use Black\User\Infrastructure\Service\UserStatusService;
use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\EventDispatcher;

class LockUserHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Infrastructure\CQRS\Handler\LockUserHandler');

    }

    function let(UserWriteRepository $repository, UserStatusService $statusService, EventDispatcher $dispatcher)
    {
        $this->beConstructedWith($repository, $statusService, $dispatcher);
    }

    function it_should_handle_a_command(
        User $user,
        LockUserCommand $command,
        UserStatusService $service,
        UserLockedEvent $event
    ) {
        $command->getUser()->willReturn($user);
        $service->activate($user)->willReturn($user);
        $event->getUser()->willReturn($user);

        $this->handle($command);
    }
}
