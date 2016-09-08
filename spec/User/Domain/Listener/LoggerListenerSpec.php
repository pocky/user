<?php

namespace spec\Black\User\Domain\Listener;

use Black\User\Domain\Event\UserActivatedEvent;
use Black\User\UserDomainEvents;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Event;

class LoggerListenerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Black\User\Domain\Listener\LoggerListener');
        $this->shouldImplement('Symfony\Component\EventDispatcher\EventSubscriberInterface');
    }

    function let(LoggerInterface $logger)
    {
        $this->beConstructedWith($logger);
    }

    function it_should_have_subscribed_events()
    {
        $this::getSubscribedEvents()->shouldBeArray();
    }

    function it_should_have_an_info_log(UserActivatedEvent $event)
    {
        $this->addInfoLog($event);
    }
}
