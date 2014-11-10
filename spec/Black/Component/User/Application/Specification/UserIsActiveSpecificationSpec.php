<?php

namespace spec\Black\Component\User\Application\Specification;

use Black\Component\User\Domain\Model\User;
use Black\Component\User\Domain\Model\UserId;
use PhpSpec\ObjectBehavior;

class UserIsActiveSpecificationSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Application\Specification\UserIsActiveSpecification');
        $this->shouldImplement('Black\DDD\DDDinPHP\Application\Specification\Specification');
    }

    public function it_should_satisfies_a_specification()
    {
        $user = new User(new UserId(1234), 'test', 'password');
        $user->activate();

        $this->isSatisfiedBy($user)->shouldReturn(true);
    }
}
