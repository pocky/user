<?php

namespace spec\Black\User\Infrastructure\Password;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EncoderSpec extends ObjectBehavior
{
    protected $password;

    protected $hash;

    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Infrastructure\Password\Encoder');

        $this->password = 'password';
    }

    function it_should_encode_password()
    {
        $this->hash = $this->encode($this->password, mcrypt_create_iv(22, MCRYPT_DEV_URANDOM))->shouldBeString();
    }

    function it_should_verify_password()
    {
        $this->verify($this->password, $this->hash);
    }
}
