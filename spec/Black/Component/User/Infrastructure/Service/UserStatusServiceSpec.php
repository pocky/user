<?php

namespace spec\Black\Component\User\Infrastructure\Service;

use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\Component\User\Infrastructure\Service\UserWriteService;
use Domain\Model\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserStatusServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\Service\UserStatusService');
    }

    function let(UserManager $manager, UserWriteService $writeService)
    {
        $this->beConstructedWith($manager, $writeService);
    }
}
