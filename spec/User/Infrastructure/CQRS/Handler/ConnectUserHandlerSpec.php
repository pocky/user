<?php

namespace spec\Black\User\Infrastructure\CQRS\Handler;

use Black\User\Domain\Entity\User;
use Black\User\Domain\ValueObject\UserId;
use Black\User\Infrastructure\CQRS\Command\ConnectUserCommand;
use Black\User\Infrastructure\Persistence\CQRS\WriteRepository;
use Black\User\Infrastructure\Service\UserStatusService;
use Email\EmailAddress;
use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ConnectUserHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Infrastructure\CQRS\Handler\ConnectUserHandler');

    }

    function let(WriteRepository $repository, UserStatusService $service, EventDispatcherInterface $dispatcher)
    {
        $this->beConstructedWith($repository, $service, $dispatcher);
    }

    function it_should_handle_a_command()
    {
        $user = new User(new UserId(1), 'test', new EmailAddress('test@test.com'));
        $command = new ConnectUserCommand($user);

        $this->handle($command);
    }
}
