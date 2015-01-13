<?php
namespace spec\Black\Component\User\Application\DTO;

use Black\Component\User\Domain\Model\UserId;
use Email\EmailAddress;
use PhpSpec\ObjectBehavior;

class CreateUserDTOSpec extends ObjectBehavior
{
    public function let(UserId $id)
    {
        $id->getValue()->willReturn("1");
        $email = new EmailAddress("test@test.com");

        $this->beConstructedWith($id, 'test', $email);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Application\DTO\CreateUserDTO');
        $this->shouldImplement('Black\DDD\DDDinPHP\Application\DTO\DTO');
    }

    public function it_should_return_id()
    {
        $this->getId()->getValue()->shouldReturn("1");
    }

    public function it_should_return_name()
    {
        $this->getName()->shouldReturn('test');
    }

    public function it_should_return_email()
    {
        $this->getEmail()->getValue()->shouldReturn("test@test.com");
    }

    public function it_should_serialize()
    {
        $this->serialize()->shouldBeString();
    }

    public function it_should_unserialize()
    {
        $serialized = $this->serialize();

        $object = $this->unserialize($serialized);
        $object->shouldBeArray();
    }
}