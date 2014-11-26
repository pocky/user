<?php

namespace spec\Black\Component\User\Infrastructure\CQRS\Handler;

use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\CQRS\Command\ActiveUserCommand;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\Component\User\Infrastructure\DomainEvent\UserActivateSubscriber;
use Black\Component\User\Infrastructure\Service\UserStatusService;
use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher;

class ActiveUserHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Black\Component\User\Infrastructure\CQRS\Handler\ActiveUserHandler');
        $this->shouldImplement('Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler');
    }

    public function let(
        UserManager $userManager,
        UserStatusService $service,
        TraceableEventDispatcher $dispatcher,
        UserActivateSubscriber $subscriber
    ) {
        $this->beConstructedWith($userManager, $service, $dispatcher, $subscriber);
    }

    public function it_should_handle_a_command()
    {
        $command = new ActiveUserCommand(new UserId('1'));

        $this->handle($command);
    }
}
