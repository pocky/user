<?php

namespace spec\Black\Component\User\Domain\Exception;

use PhpSpec\ObjectBehavior;

class UserNotFoundExceptionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Domain\Exception\UserNotFoundException');
        $this->shouldBeAnInstanceOf('Symfony\Component\HttpKernel\Exception\NotFoundHttpException');
    }

    public function let()
    {
        $message   = 'User Not Found!';
        $exception = new \Exception();
        $code      = 0;

        $this->beConstructedWith($message, $exception, $code);
    }

    public function it_should_throw_an_http_exception()
    {
        $this->shouldThrow('Symfony\Component\HttpKernel\Exception\NotFoundHttpException');
    }
}
