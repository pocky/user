<?php

namespace spec\Black\User\Infrastructure\CQRS\Handler;

use Black\User\Domain\Event\UserActivatedEvent;
use Black\User\Domain\Entity\User;
use Black\User\Infrastructure\CQRS\Command\DeactiveUserCommand;
use Black\User\Infrastructure\Persistence\CQRS\WriteRepository;
use Black\User\Infrastructure\Service\UserStatusService;
use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\EventDispatcher;

class DeactiveUserHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Infrastructure\CQRS\Handler\DeactiveUserHandler');
    }

    function let(
        WriteRepository $repository,
        UserStatusService $service,
        EventDispatcher $dispatcher
    ) {
        $this->beConstructedWith($repository, $service, $dispatcher);
    }

    function it_should_handle_a_command(
        DeactiveUserCommand $command,
        User $user,
        UserActivatedEvent $event,
        UserStatusService $service
    ) {
        $command->getUser()->willReturn($user);
        $service->deactivate($user)->willReturn($user);
        $event->getUser()->willReturn($user);

        $this->handle($command);
    }
}
