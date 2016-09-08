<?php

namespace spec\Black\User\Infrastructure\CQRS\Command;

use Black\User\Domain\Entity\User;
use PhpSpec\ObjectBehavior;

class ActiveUserCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Infrastructure\CQRS\Command\ActiveUserCommand');

    }

    function let(User $user)
    {
        $this->beConstructedWith($user);
    }

    function it_should_return_a_user()
    {
        $this->getUser()->shouldBeAnInstanceOf('Black\User\Domain\Entity\User');
    }
}
