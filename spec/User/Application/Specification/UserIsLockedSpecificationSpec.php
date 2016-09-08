<?php

namespace spec\Black\User\Application\Specification;

use Black\User\Domain\Entity\User;
use Black\User\Domain\Entity\UserId;
use Email\EmailAddress;
use PhpSpec\ObjectBehavior;

class UserIsLockedSpecificationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Application\Specification\UserIsLockedSpecification');
    }

    function it_should_satisfy_the_specification()
    {
        $user = new User(new UserId(1234), 'test', new EmailAddress("email@domain.tld"));
        $this->isSatisfiedBy($user)->shouldReturn(false);
    }
}
