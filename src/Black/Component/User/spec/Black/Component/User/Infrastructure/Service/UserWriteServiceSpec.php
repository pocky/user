<?php

namespace spec\Black\Component\User\Infrastructure\Service;

use Black\Component\User\Infrastructure\Doctrine\UserManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserWriteServiceSpec extends ObjectBehavior
{
    protected $manager;

    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\Service\UserWriteService');
        $this->shouldImplement('Black\DDD\DDDinPHP\Infrastructure\Service\InfrastructureService');
    }

    function let(UserManager $manager)
    {
        $this->manager = $manager;

        $this->beConstructedWith($this->manager);
    }
}
