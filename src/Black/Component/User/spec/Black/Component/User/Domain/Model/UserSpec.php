<?php

namespace spec\Black\Component\User\Domain\Model;

use Black\Component\User\Domain\Model\UserId;
use PhpSpec\ObjectBehavior;

class UserSpec extends ObjectBehavior
{
    protected $userId;

    protected $username;

    protected $email;

    protected $password;

    protected $groups;

    protected $roles;

    protected $active;

    protected $locked;

    protected $rawPassword;

    protected $registeredAt;

    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Domain\Model\User');
        $this->shouldBeAnInstanceOf('Black\DDD\DDDinPHP\Domain\Model\Entity');
    }

    public function let()
    {
        $this->userId   = new UserId(1);
        $this->username = 'test';
        $this->email    = 'test@test.com';

        $this->beConstructedWith($this->userId, $this->username, $this->email);
        $this->getGroups()->shouldBeAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
        $this->getRoles()->shouldBeAnInstanceOf('Doctrine\Common\Collections\ArrayCollection');
    }

    public function it_should_have_a_userId()
    {
        $this->getUserId()->shouldBeAnInstanceOf('Black\Component\User\Domain\Model\UserId');
        $this->getUserId()->getValue()->shouldReturn("1");
    }

    public function it_should_have_a_username()
    {
        $this->getUsername()->shouldReturn('test');
    }

    public function it_should_have_an_email()
    {
        $this->getEmail()->shouldReturn('test@test.com');
    }

    public function it_should_not_have_a_group()
    {
        $this->getGroups()->isEmpty()->shouldReturn(true);
    }

    public function it_should_not_have_a_role()
    {
        $this->getRoles()->isEmpty()->shouldReturn(true);
    }

    public function it_should_register_an_user()
    {
        $this->rawPassword  = 'password';

        $this->register($this->rawPassword);

        $this->isActive()->shouldReturn(false);
        $this->isLocked()->shouldReturn(false);
        $this->getPassword()->shouldBeString();
        $this->getRegisteredAt()->shouldImplement('\DateTime');
    }

    public function it_should_active_an_account()
    {
        $this->activate();

        $this->isActive()->shouldReturn(true);
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

    public function it_should_update_an_account()
    {
        $this->updatePassword('newPass');
        $this->getUpdatedAt()->shouldImplement('\DateTime');
    }
}
