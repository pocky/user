<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Command;

use Black\Component\User\Domain\Model\UserId;
use Documents\User;
use PhpSpec\ObjectBehavior;

class ConnectUserCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Command\ConnectUserCommand');
        $this->shouldImplement('Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command');
    }

    function let()
    {
        $this->beConstructedWith("username");
    }

    function it_should_return_a_userId()
    {
        $this->getUsername()->shouldReturn("username");
    }
}
