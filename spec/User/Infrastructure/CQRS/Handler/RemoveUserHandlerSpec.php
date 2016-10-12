<?php

namespace spec\Black\User\Infrastructure\CQRS\Handler;

use Black\User\Domain\ValueObject\UserId;
use Black\User\Domain\Entity\UserReadRepository;
use Black\User\Infrastructure\CQRS\Command\RemoveUserCommand;
use Black\User\Infrastructure\Persistence\CQRS\WriteRepository;
use Black\User\Domain\Event\UserRemovedSubscriber;
use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\EventDispatcher;

class RemoveUserHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Infrastructure\CQRS\Handler\RemoveUserHandler');

    }

    function let(
        UserReadRepository $readRepository,
        WriteRepository $writeRepository,
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
