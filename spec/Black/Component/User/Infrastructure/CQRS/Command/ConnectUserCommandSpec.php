<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Command;

use Black\Component\User\Domain\Model\User;
use PhpSpec\ObjectBehavior;

class ConnectUserCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Command\ConnectUserCommand');

    }

    function let(User $user)
    {
        $this->beConstructedWith($user);
    }

    function it_should_return_an_user()
    {
        $this->getUser()->shouldImplement('Black\Component\User\Domain\Model\User');
    }
}
