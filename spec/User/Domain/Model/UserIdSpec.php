<?php

namespace spec\Black\User\Domain\Model;

use Black\User\Domain\ValueObject\UserId;
use PhpSpec\ObjectBehavior;

class UserIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Domain\ValueObject\UserId');
    }

    function let()
    {
        $this->beConstructedWith(1);
    }

    function it_should_have_a_value()
    {
        $this->getValue()->shouldBeEqualTo("1");
    }

    function it_should_have_a_toString()
    {
        $this->__toString()->shouldBeEqualTo("1");
    }

    function it_should_be_equal(UserId $userId)
    {
        $userId->getValue()->willReturn("1");
        $this->isEqualTo($userId)->shouldReturn(true);
    }

    function it_should_not_be_equal(UserId $userId)
    {
        $userId->getValue()->willReturn("12");
        $this->isEqualTo($userId)->shouldReturn(false);
    }
}
