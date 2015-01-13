<?php

namespace spec\Black\Component\User\Infrastructure\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Black\Component\User\Infrastructure\Doctrine\UserManager;


class RegisterServiceSpec extends ObjectBehavior
{
    protected $manager;

    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\Service\RegisterService');
        $this->shouldImplement('Black\DDD\DDDinPHP\Infrastructure\Service\InfrastructureService');
    }

    function let(UserManager $manager)
    {
        $this->manager = $manager;

        $this->beConstructedWith($this->manager);
    }
}
