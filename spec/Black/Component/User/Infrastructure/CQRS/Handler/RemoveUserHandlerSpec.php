<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Handler;

use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\CQRS\Command\RemoveUserCommand;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\Component\User\Infrastructure\DomainEvent\UserRemovedSubscriber;
use PhpSpec\ObjectBehavior;
use Symfony\Component\HttpKernel\Debug\TraceableEventDispatcher;

class RemoveUserHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Handler\RemoveUserHandler');
        $this->shouldImplement('Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler');
    }

    public function let(
        UserManager $userManager,
        TraceableEventDispatcher $dispatcher,
        UserRemovedSubscriber $subscriber
    ) {
        $this->beConstructedWith($userManager, $dispatcher, $subscriber);
    }

    public function it_should_handle_a_command()
    {
        $command  = new RemoveUserCommand(new UserId('1'));

        $this->handle($command);
    }
}
