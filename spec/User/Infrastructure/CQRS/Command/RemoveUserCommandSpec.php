<?php

namespace spec\Black\User\Infrastructure\CQRS\Command;

use Black\User\Domain\Entity\UserId;
use PhpSpec\ObjectBehavior;

class RemoveUserCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Infrastructure\CQRS\Command\RemoveUserCommand');

    }

    function let()
    {
        $userId = new UserId(1234);

        $this->beConstructedWith($userId);
    }

    function it_should_return_a_userId()
    {
        $this->getUserId()->shouldBeAnInstanceOf('Black\User\Domain\Entity\UserId');
        $this->getUserId()->getValue()->shouldBeString();
        $this->getUserId()->getValue()->shouldReturn("1234");
    }
}
