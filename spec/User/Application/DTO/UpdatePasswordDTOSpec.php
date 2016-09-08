<?php

namespace spec\Black\User\Application\DTO;

use Black\User\Domain\Entity\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdatePasswordDTOSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Application\DTO\UpdatePasswordDTO');

    }

    function let()
    {
        $this->beConstructedWith(1234, "password");
    }

    function it_should_have_an_id()
    {
        $this->getId()->shouldReturn(1234);
    }

    function it_should_have_a_password()
    {
        $this->getPassword()->shouldReturn("password");
    }
}
