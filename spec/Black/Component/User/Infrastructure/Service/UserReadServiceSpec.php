<?php

namespace spec\Black\Component\User\Infrastructure\Service;

use Black\Component\User\Infrastructure\Doctrine\UserManager;
use PhpSpec\ObjectBehavior;

class UserReadServiceSpec extends ObjectBehavior
{
    protected $manager;

    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\Service\UserReadService');
        $this->shouldImplement('Black\DDD\DDDinPHP\Infrastructure\Service\InfrastructureService');
    }

    function let(UserManager $manager)
    {
        $this->manager = $manager;

        $this->beConstructedWith($this->manager);
    }
}
