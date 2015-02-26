<?php

namespace spec\Black\Component\User\Domain\Model;

use Black\Component\User\Domain\Model\UserId;
use Email\EmailAddress;
use PhpSpec\ObjectBehavior;

class UserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Domain\Model\User');
        $this->shouldBeAnInstanceOf('Black\DDD\DDDinPHP\Domain\Model\Entity');
    }

    function let()
    {
        $userId = new UserId(1);
        $email = new EmailAddress('test@test.com');

        $this->beConstructedWith($userId, 'test', $email);
    }

    function it_should_have_a_userId()
    {
        $this->getUserId()->shouldBeAnInstanceOf('Black\Component\User\Domain\Model\UserId');
        $this->getUserId()->getValue()->shouldReturn("1");
    }

    function it_should_have_a_name()
    {
        $this->getName()->shouldReturn('test');
    }

    function it_should_have_an_email()
    {
        $this->getEmail()->shouldBeAnInstanceOf('Email\EmailAddress');
        $this->getEmail()->getValue()->shouldReturn('test@test.com');
    }

    function it_should_register_an_user()
    {
        $this->register('password');

        $this->isActive()->shouldReturn(false);
        $this->isLocked()->shouldReturn(false);
        $this->getPassword()->shouldBeString();
        $this->getRegisteredAt()->shouldImplement('\DateTime');

        $this->getPassword()->shouldReturn('password');
    }

    function it_should_active_an_account()
    {
        $this->activate();
        $this->isActive()->shouldReturn(true);
    }

    function it_should_lock_an_account()
    {
        $this->lock();
        $this->isLocked()->shouldReturn(true);
    }

    function it_should_unlock_an_account()
    {
        $this->unlock();
        $this->isLocked()->shouldReturn(false);
    }

    function it_should_connect_an_user()
    {
        $this->connect();

        $this->getNumberOfConnection()->shouldBeInt();
        $this->getLastConnection()->shouldImplement('\DateTime');
    }

    function it_should_update_a_password()
    {
        $this->updatePassword('newPass');
        $this->getUpdatedAt()->shouldImplement('\DateTime');
    }

    function it_should_update_an_account()
    {
        $previousName = $this->getName();
        $previousMail = $this->getEmail();

        $address = new EmailAddress('test2@test.com');
        $this->updateAccount('testUser', $address);

        $this->getName()->shouldNotReturn($previousName);
        $this->getEmail()->shouldNotReturn($previousMail);
    }

    function it_should_deactivate_an_account()
    {
        $this->deactivate();
        $this->isActive()->shouldReturn(false);
    }
}
