<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Command;

use Black\Component\User\Domain\Model\UserId;
use PhpSpec\ObjectBehavior;

class CreateUserCommandSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Command\CreateUserCommand');
        $this->shouldImplement('Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command');
    }

    public function let()
    {
        $userId = new UserId('1234');
        $this->beConstructedWith($userId, "name", "email", "password");
    }

    public function it_should_have_a_userId()
    {
        $this->getUserId()->shouldBeAnInstanceOf('Black\Component\User\Domain\Model\UserId');
        $this->getUserId()->getValue()->shouldBeString();
        $this->getUserId()->getValue()->shouldReturn('1234');
    }

    public function it_should_have_a_name()
    {
        $this->getName()->shouldBeString();
        $this->getName()->shouldReturn('name');
    }

    public function it_should_have_an_email()
    {
        $this->getEmail()->shouldBeString();
        $this->getEmail()->shouldReturn('email');
    }

    public function it_should_have_a_password()
    {
        $this->getPassword()->shouldBestring();
        $this->getPassword()->shouldReturn("password");
    }
}
