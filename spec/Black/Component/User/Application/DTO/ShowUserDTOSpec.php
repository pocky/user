<?php
namespace spec\Black\Component\User\Application\DTO;

use Black\Component\User\Domain\Model\UserId;
use Email\EmailAddress;
use PhpSpec\ObjectBehavior;

class ShowUserDTOSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Application\DTO\ShowUserDTO');

    }

    function let()
    {
        $this->beConstructedWith(1, 'test', "test@test.com");
    }

    function it_should_return_id()
    {
        $this->getId()->shouldReturn(1);
    }

    function it_should_return_an_username()
    {
        $this->getUsername()->shouldReturn('test');
    }

    function it_should_return_an_email_address()
    {
        $this->getEmailAddress()->shouldReturn("test@test.com");
    }

    function it_should_serialize()
    {
        $this->serialize()->shouldBeString();
    }

    function it_should_unserialize()
    {
        $serialized = $this->serialize();

        $object = $this->unserialize($serialized);
        $object->shouldHaveType('Black\Component\User\Application\DTO\ShowUserDTO');
    }
}
