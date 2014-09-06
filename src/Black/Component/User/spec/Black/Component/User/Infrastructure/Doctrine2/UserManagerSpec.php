<?php

namespace spec\Black\Component\User\Infrastructure\Doctrine;

use Black\Component\User\Domain\Model\UserId;
use Doctrine\Common\Persistence\ObjectManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserManagerSpec extends ObjectBehavior
{
    protected $userId;

    protected $user;

    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\Doctrine\UserManager');
        $this->shouldBeAnInstanceOf('Black\Component\Common\Infrastructure\Doctrine\CommonManager');
    }

    function let(ObjectManager $objectManager)
    {
        $this->userId = new UserId(1234);

        $class = "Black\\Common\\User\\Domain\\Model\\User";

        $this->beConstructedWith($objectManager, $class);
    }

    function it_should_create_an_user()
    {
        $this->user = $this->createUser($this->userId, 'username', 'password');
    }

    function it_should_find_an_user()
    {
        $this->find($this->userId);
    }

    function it_should_find_all_users()
    {
        $this->findAll();
    }

    function id_should_add_an_user()
    {
        $this->add($this->user);
    }

    function it_should_remove_an_user()
    {
        $this->remove($this->user);
    }
}
