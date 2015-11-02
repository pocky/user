<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Handler;

use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\CQRS\Command\ActiveUserCommand;
use Black\Component\User\Domain\Model\UserWriteRepository;
use Black\Component\User\Domain\Event\UserActivateSubscriber;
use Black\Component\User\Infrastructure\Service\UserStatusService;
use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ActiveUserHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Handler\ActiveUserHandler');

    }

    function let(
        UserWriteRepository $repository,
        UserStatusService $service,
        EventDispatcher $dispatcher
    ) {
        $this->beConstructedWith($repository, $service, $dispatcher);
    }

    function it_should_handle_a_command()
    {
        $command = new ActiveUserCommand(new UserId('1'));

        $this->handle($command);
    }
}
