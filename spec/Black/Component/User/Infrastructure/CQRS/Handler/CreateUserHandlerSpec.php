<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Handler;

use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\CQRS\Command\CreateUserCommand;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\Component\User\Infrastructure\Service\RegisterService;
use PhpSpec\ObjectBehavior;

class CreateUserHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Handler\CreateUserHandler');
        $this->shouldImplement('Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler');
    }

    public function let(UserManager $userManager, RegisterService $service)
    {
        $this->beConstructedWith($userManager, $service);
    }

    public function it_should_handle_a_command()
    {
        $command = new CreateUserCommand(new UserId('1'), 'test', 'email', 'password');

        $this->handle($command);
    }
}
