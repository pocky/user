<?php

namespace spec\Black\Component\User\Application\DTO;

use Black\Component\User\Domain\Model\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdatePasswordDTOSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Application\DTO\UpdatePasswordDTO');
        $this->shouldImplement('Black\DDD\DDDinPHP\Application\DTO\DTO');
    }

    function let()
    {
        $this->beConstructedWith(1234, "password");
    }

    function it_should_have_an_id()
    {
        $this->getUserId()->shouldReturn(1234);
    }

    function it_should_have_a_password()
    {
        $this->getPassword()->shouldReturn("password");
    }
}
