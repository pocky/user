<?php

namespace spec\Black\Component\User\Infrastructure\Password;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EncoderSpec extends ObjectBehavior
{
    protected $password;

    protected $hash;

    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\Password\Encoder');

        $this->password = 'password';
    }

    public function it_should_encode_password()
    {
        $this->hash = $this->encode($this->password, mcrypt_create_iv(22, MCRYPT_DEV_URANDOM))->shouldBeString();
    }

    public function it_should_verify_password()
    {
        $this->verify($this->password, $this->hash);
    }
}
