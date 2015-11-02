<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Handler;

use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\CQRS\Command\CreateUserCommand;
use Black\Component\User\Domain\Model\UserWriteRepository;
use Black\Component\User\Domain\Event\UserCreatedSubscriber;
use Black\Component\User\Infrastructure\Service\RegisterService;
use Email\EmailAddress;
use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\EventDispatcher;

class CreateUserHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Handler\CreateUserHandler');

    }

    function let(
        UserWriteRepository $repository,
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
