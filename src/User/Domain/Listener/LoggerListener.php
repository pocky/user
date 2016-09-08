<?php

namespace Black\User\Domain\Listener;

use Black\User\UserDomainEvents;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class LoggerListener
 */
class LoggerListener implements EventSubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            UserDomainEvents::USER_DOMAIN_LOGGED => "addInfoLog",
            UserDomainEvents::USER_DOMAIN_ACTIVATED => 'addInfoLog',
            UserDomainEvents::USER_DOMAIN_DEACTIVATED => 'addInfoLog',
            UserDomainEvents::USER_DOMAIN_LOCKED => 'addInfoLog',
            UserDomainEvents::USER_DOMAIN_UNLOCKED => 'addInfoLog',
            UserDomainEvents::USER_DOMAIN_CREATED => 'addInfoLog',
            UserDomainEvents::USER_DOMAIN_UPDATED => 'addInfoLog',
            UserDomainEvents::USER_DOMAIN_REGISTERED => 'addInfoLog',
            UserDomainEvents::USER_DOMAIN_REMOVED => 'addInfoLog',
            UserDomainEvents::USER_NOT_FOUND => 'addErrorLog',
        ];
    }

    /**
     * @param Event $event
     */
    public function addInfoLog(Event $event)
    {
        $this->logger->info($event->message());
    }

    /**
     * @param Event $event
     */
    public function addErrorLog(Event $event)
    {
        $this->logger->error($event->message());
    }
}
