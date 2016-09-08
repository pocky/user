<?php

namespace spec\Black\User\Infrastructure\CQRS\Command;

use Black\User\Domain\Entity\UserId;
use Email\EmailAddress;
use PhpSpec\ObjectBehavior;

class CreateUserCommandSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Infrastructure\CQRS\Command\CreateUserCommand');

    }

    function let()
    {
        $userId = new UserId('1234');
        $email = new EmailAddress("email@domain.tld");

        $this->beConstructedWith($userId, "name", $email);
    }

    function it_should_have_a_userId()
    {
        $this->getUserId()->shouldBeAnInstanceOf('Black\User\Domain\Entity\UserId');
        $this->getUserId()->getValue()->shouldBeString();
        $this->getUserId()->getValue()->shouldReturn('1234');
    }

    function it_should_have_a_name()
    {
        $this->getName()->shouldBeString();
        $this->getName()->shouldReturn("name");
    }

    function it_should_have_an_email()
    {
        $this->getEmail()->shouldBeAnInstanceOf('Email\EmailAddress');
        $this->getEmail()->getValue()->shouldBeString();
        $this->getEmail()->getValue()->shouldReturn("email@domain.tld");
    }
}
