<?php

namespace spec\Black\User\Infrastructure\CQRS\Handler;

use Black\User\Domain\ValueObject\UserId;
use Black\User\Infrastructure\CQRS\Command\CreateUserCommand;
use Black\User\Infrastructure\Persistence\CQRS\WriteRepository;
use Black\User\Domain\Event\UserCreatedSubscriber;
use Black\User\Infrastructure\Service\RegisterService;
use Email\EmailAddress;
use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\EventDispatcher;

class CreateUserHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Infrastructure\CQRS\Handler\CreateUserHandler');

    }

    function let(
        WriteRepository $repository,
        RegisterService $service,
        EventDispatcher $dispatcher
    ) {
        $this->beConstructedWith($repository, $service, $dispatcher);
    }

    function it_should_handle_a_command()
    {
        $command = new CreateUserCommand(new UserId('1'), 'test', new EmailAddress("email@domain.tld"), 'password');

        $this->handle($command);
    }
}
