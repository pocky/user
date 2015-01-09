<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Command;

use Black\Component\User\Domain\Model\UserId;
use Documents\User;
use PhpSpec\ObjectBehavior;

class ConnectUserCommandSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Command\ConnectUserCommand');
        $this->shouldImplement('Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command');
    }

    public function let()
    {
        $this->beConstructedWith("username");
    }

    public function it_should_return_a_userId()
    {
        $this->getUsername()->shouldReturn("username");
    }
}
