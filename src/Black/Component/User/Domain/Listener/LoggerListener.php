<?php
/*
 * This file is part of the ${FILE_HEADER_PACKAGE}.
 *
 * ${FILE_HEADER_COPYRIGHT}
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Black\Component\User\Domain\Listener;

use Black\Component\User\UserDomainEvents;
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
            UserDomainEvents::USER_DOMAIN_LOCKED => 'addInfoLog',
            UserDomainEvents::USER_DOMAIN_CREATED => 'addInfoLog',
            UserDomainEvents::USER_DOMAIN_REGISTERED => 'addInfoLog',
            UserDomainEvents::USER_DOMAIN_REMOVED => 'addInfoLog'
        ];
    }

    /**
     * @param Event $event
     */
    public function addInfoLog(Event $event)
    {
        $this->logger->info($event->message());
    }
}
