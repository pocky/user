<?php

namespace spec\Black\Component\User\Application\Specification;

use Black\Component\User\Domain\Model\User;
use Black\Component\User\Domain\Model\UserId;
use Email\EmailAddress;
use PhpSpec\ObjectBehavior;

class UserIsLockedSpecificationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Application\Specification\UserIsLockedSpecification');
        $this->shouldImplement('Black\DDD\DDDinPHP\Application\Specification\Specification');
    }

    function it_should_satisfy_the_specification()
    {
        $user = new User(new UserId(1234), 'test', new EmailAddress("email@domain.tld"));
        $this->isSatisfiedBy($user)->shouldReturn(false);
    }
}
