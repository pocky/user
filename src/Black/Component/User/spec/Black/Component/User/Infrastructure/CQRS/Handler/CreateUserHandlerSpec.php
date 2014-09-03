<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Handler;

use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\CQRS\Command\CreateUserCommand;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreateUserHandlerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Handler\CreateUserHandler');
        $this->shouldImplement('Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler');
    }

    function let(UserManager $userManager)
    {
        $this->beConstructedWith($userManager);
    }

    function it_should_handle_a_command()
    {
        $command = new CreateUserCommand(new UserId('1'), 'test', 'password');

        $this->handle($command);
    }
}
