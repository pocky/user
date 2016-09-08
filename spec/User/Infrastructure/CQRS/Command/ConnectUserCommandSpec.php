<?php

namespace spec\Black\User\Infrastructure\CQRS\Command;

use Black\User\Domain\Entity\User;
use PhpSpec\ObjectBehavior;

class ConnectUserCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Infrastructure\CQRS\Command\ConnectUserCommand');

    }

    function let(User $user)
    {
        $this->beConstructedWith($user);
    }

    function it_should_return_an_user()
    {
        $this->getUser()->shouldImplement('Black\User\Domain\Entity\User');
    }
}
