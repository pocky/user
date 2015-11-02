<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Handler;

use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\CQRS\Command\UnlockUserCommand;
use Black\Component\User\Domain\Model\UserWriteRepository;
use Black\Component\User\Infrastructure\Service\UserStatusService;
use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\EventDispatcher;

class UnlockUserHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Handler\UnlockUserHandler');

    }

    function let(UserWriteRepository $repository, UserStatusService $statusService, EventDispatcher $dispatcher)
    {
        $this->beConstructedWith($repository, $statusService, $dispatcher);
    }

    function it_should_handle_a_command()
    {
        $command  = new UnlockUserCommand(new UserId('1'));

        $this->handle($command);
    }
}
