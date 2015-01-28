<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Command;

use Black\Component\User\Domain\Model\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PasswordUserCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Command\PasswordUserCommand');
        $this->shouldImplement('Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command');
    }

    function let(UserId $userId)
    {
        $this->beConstructedWith($userId, "password", "passwordConfirm");
    }

    function it_should_have_an_userId(UserId $userId)
    {
        $this->getUserId()->shouldReturn($userId);
    }

    function it_should_have_a_password()
    {
        $this->getPassword()->shouldReturn("password");
    }

    function it_should_have_a_password_confirmation()
    {
        $this->getPasswordConfirmation()->shouldReturn("passwordConfirm");
    }
}
