<?php
namespace spec\Black\User\Application\DTO;

use Black\User\Domain\Entity\UserId;
use PhpSpec\ObjectBehavior;

class ActiveUserDTOSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Application\DTO\ActiveUserDTO');

    }

    function let(UserId $id)
    {
        $id->getValue()->willReturn("1");
        $this->beConstructedWith($id);
    }

    function it_should_return_id()
    {
        $this->getId()->getValue()->shouldReturn("1");
    }

    function it_should_unserialize()
    {
        $serialized = $this->serialize();

        $object = $this->unserialize($serialized);
        $object->shouldBeArray();
    }
}
