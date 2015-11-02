<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Handler;

use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Domain\Model\UserReadRepository;
use Black\Component\User\Infrastructure\CQRS\Command\RemoveUserCommand;
use Black\Component\User\Domain\Model\UserWriteRepository;
use Black\Component\User\Domain\Event\UserRemovedSubscriber;
use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\EventDispatcher;

class RemoveUserHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Handler\RemoveUserHandler');

    }

    function let(
        UserReadRepository $readRepository,
        UserWriteRepository $writeRepository,
        EventDispatcher $dispatcher
    ) {
        $this->beConstructedWith($readRepository, $writeRepository, $dispatcher);
    }

    function it_should_handle_a_command()
    {
        $command = new RemoveUserCommand(new UserId('1'));

        $this->handle($command);
    }
}
