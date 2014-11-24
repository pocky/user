<?php
namespace spec\Black\Component\User\Application\DTO;

use PhpSpec\ObjectBehavior;

class CreateUserDTOSpec extends ObjectBehavior
{
    protected $id;

    protected $name;

    protected $email;

    public function let()
    {
        $this->beConstructedWith(1, 'test', 'test@test.com');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Application\DTO\CreateUserDTO');
        $this->shouldImplement('Black\DDD\DDDinPHP\Application\DTO\DTO');
    }

    public function it_should_return_id()
    {
        $this->getId()->shouldReturn(1);
    }

    public function it_should_return_name()
    {
        $this->getName()->shouldReturn('test');
    }

    public function it_should_return_email()
    {
        $this->getEmail()->shouldReturn('test@test.com');
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