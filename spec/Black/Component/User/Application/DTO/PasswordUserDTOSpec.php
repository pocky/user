<?php

namespace spec\Black\Component\User\Application\DTO;

use Black\Component\User\Domain\Model\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PasswordUserDTOSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Application\DTO\PasswordUserDTO');
        $this->shouldImplement('Black\DDD\DDDinPHP\Application\DTO\DTO');
    }

    function let(UserId $userId)
    {
        $this->beConstructedWith($userId, "password", "passwordConfirm");
    }

    function it_should_have_an_id(UserId $userId)
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
