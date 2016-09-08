<?php

namespace spec\Black\User\Domain\Exception;

use PhpSpec\ObjectBehavior;

class UserNotFoundExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Domain\Exception\UserNotFoundException');
        $this->shouldBeAnInstanceOf('Symfony\Component\HttpKernel\Exception\NotFoundHttpException');
    }

    function let()
    {
        $message   = 'User Not Found!';
        $exception = new \Exception();
        $code      = 0;

        $this->beConstructedWith($message, $exception, $code);
    }

    function it_should_throw_an_http_exception()
    {
        $this->shouldThrow('Symfony\Component\HttpKernel\Exception\NotFoundHttpException');
    }
}
