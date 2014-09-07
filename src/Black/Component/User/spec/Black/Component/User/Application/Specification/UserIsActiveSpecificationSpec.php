<?php

namespace spec\Black\Component\User\Application\Specification;

use Black\Component\User\Domain\Model\User;
use Black\Component\User\Domain\Model\UserId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserIsActiveSpecificationSpec extends ObjectBehavior
{
    protected $user;

    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Application\Specification\UserIsActiveSpecification');
        $this->shouldImplement('Black\DDD\DDDinPHP\Application\Specification\Specification');
    }

    function let()
    {
        $this->user = new User(new UserId(1234), 'test', 'password');

    }

    function it_should_satisfies_a_specification()
    {
        $this->user->activate();

        $this->isSatisfiedBy($this->user)->shouldReturn(true);
    }
}
