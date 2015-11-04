<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Command;

use Black\Component\User\Domain\Model\User;
use PhpSpec\ObjectBehavior;

class DeactiveUserCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Command\DeactiveUserCommand');

    }

    function let(User $user)
    {
        $this->beConstructedWith($user);
    }

    function it_should_return_a_user()
    {
        $this->getUser()->shouldBeAnInstanceOf('Black\Component\User\Domain\Model\User');
    }
}
