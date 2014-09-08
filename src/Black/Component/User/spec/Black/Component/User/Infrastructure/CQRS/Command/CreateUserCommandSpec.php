<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Command;

use Black\Component\User\Domain\Model\UserId;
use PhpSpec\ObjectBehavior;

class CreateUserCommandSpec extends ObjectBehavior
{
    protected $userId;

    protected $name;

    protected $password;

    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Command\CreateUserCommand');
        $this->shouldImplement('Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command');
    }

    public function let()
    {
        $this->userId   = new UserId('1234');
        $this->name = 'name';
        $this->password = 'password';

        $this->beConstructedWith($this->userId, $this->name, $this->password);
    }

    public function it_should_return_a_userId()
    {
        $this->getUserId()->shouldBeAnInstanceOf('Black\Component\User\Domain\Model\UserId');
        $this->getUserId()->getValue()->shouldBeString();
        $this->getUserId()->getValue()->shouldReturn('1234');
    }

    public function it_should_return_a_name()
    {
        $this->getName()->shouldBeString();
        $this->getName()->shouldReturn('name');
    }

    public function it_should_return_a_password()
    {
        $this->getPassword()->shouldBeString();
        $this->getPassword()->shouldReturn('password');
    }
}
