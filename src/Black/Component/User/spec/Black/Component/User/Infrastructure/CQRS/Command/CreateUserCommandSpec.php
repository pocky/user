<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Command;

use Black\Component\User\Domain\Model\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreateUserCommandSpec extends ObjectBehavior
{
    protected $userId;

    protected $username;

    protected $password;

    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Command\CreateUserCommand');
        $this->shouldImplement('Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command');
    }

    function let()
    {
        $this->userId   = new UserId('1234');
        $this->username = 'username';
        $this->password = 'password';

        $this->beConstructedWith($this->userId, $this->username, $this->password);
    }

    function it_should_return_a_userId()
    {
        $this->getUserId()->shouldBeAnInstanceOf('Black\Component\User\Domain\Model\UserId');
        $this->getUserId()->getValue()->shouldBeString();
        $this->getUserId()->getValue()->shouldReturn('1234');
    }

    function it_should_return_a_username()
    {
        $this->getUsername()->shouldBeString();
        $this->getUsername()->shouldReturn('username');
    }

    function it_should_return_a_password()
    {
        $this->getPassword()->shouldBeString();
        $this->getPassword()->shouldReturn('password');
    }
}
