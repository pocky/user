<?php

namespace spec\Black\Component\User\Domain\Model;

use Black\Component\User\Domain\Model\UserId;
use PhpSpec\ObjectBehavior;

class UserSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Domain\Model\User');
        $this->shouldBeAnInstanceOf('Black\DDD\DDDinPHP\Domain\Model\Entity');
    }

    public function let()
    {
        $userId = new UserId(1);

        $this->beConstructedWith($userId, 'test', 'test@test.com');
    }

    public function it_should_have_a_userId()
    {
        $this->getUserId()->shouldBeAnInstanceOf('Black\Component\User\Domain\Model\UserId');
        $this->getUserId()->getValue()->shouldReturn("1");
    }

    public function it_should_have_a_name()
    {
        $this->getName()->shouldReturn('test');
    }

    public function it_should_have_an_email()
    {
        $this->getEmail()->shouldReturn('test@test.com');
    }

    public function it_should_register_an_user()
    {
        $this->register('password', 'salt');

        $this->isActive()->shouldReturn(false);
        $this->isLocked()->shouldReturn(false);
        $this->getPassword()->shouldBeString();
        $this->getSalt()->shouldBeString();
        $this->getRegisteredAt()->shouldImplement('\DateTime');

        $this->getPassword()->shouldReturn('password');
        $this->getSalt()->shouldReturn('salt');
    }

    public function it_should_active_an_account()
    {
        $this->activate();
        $this->isActive()->shouldReturn(true);
    }

    public function it_should_disable_an_account()
    {
        $this->disable();
        $this->isActive()->shouldReturn(false);
    }

    public function it_should_lock_an_account()
    {
        $this->lock();
        $this->isLocked()->shouldReturn(true);
    }

    public function it_should_unlock_an_account()
    {
        $this->unlock();
        $this->isLocked()->shouldReturn(false);
    }

    public function it_should_connect_an_user()
    {
        $this->connect();

        $this->getNumberOfConnection()->shouldBeInt();
        $this->getLastConnection()->shouldImplement('\DateTime');
    }

    public function it_should_update_an_account($newPass = 'newPass')
    {
        $this->updatePassword($newPass);
        $this->getUpdatedAt()->shouldImplement('\DateTime');
    }
}
