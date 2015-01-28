<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Handler;

use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\CQRS\Command\PasswordUserCommand;
use Black\Component\User\Infrastructure\Service\UserReadService;
use Black\Component\User\Infrastructure\Service\UserWriteService;
use Domain\Model\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PasswordUserHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Handler\PasswordUserHandler');
        $this->shouldImplement('Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler');
    }

    function let(UserReadService $readService, UserWriteService $writeService)
    {
        $this->beConstructedWith($readService, $writeService);
    }

    function it_should_handle_a_command_but_throw_an_exception()
    {
        $command = new PasswordUserCommand(new UserId(1), "password", "password");

        $this->shouldThrow('Black\Component\User\Domain\Exception\UserNotFoundException')
            ->during('handle', [$command]);
    }

    function it_should_handle_a_command(UserReadService $readService, User $user)
    {
        $userId  = new UserId(1);
        $command = new PasswordUserCommand($userId, "password", "password");

        $user->getPassword()->willReturn("password");
        $readService->find($userId)->willReturn($user);

        $this->handle($command);
    }
}
