<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Black\Component\User\Infrastructure\DomainEvent;

use Black\Component\User\UserEvents;
use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class UserRegisteredSubscriber
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class UserRegisteredSubscriber implements EventSubscriberInterface
{
    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @param Logger $logger
     * @param Session $session
     */
    public function __construct(
        Logger $logger,
        Session $session
    )
    {
        $this->logger = $logger;
        $this->session = $session;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            UserEvents::USER_REGISTERED => [
                'onUserRegistered', 0
            ]
        ];
    }

    /**
     * @param UserRegisteredEvent $event
     */
    public function onUserRegistered(UserRegisteredEvent $event)
    {
        $this->logger->info($event->execute());
        $this->session->getFlashBag()->add('success', sprintf('The user %s is successfully registered', $event->getName()));
    }
}