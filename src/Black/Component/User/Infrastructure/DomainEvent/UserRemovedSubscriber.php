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

use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class UserRemovedSubscriber
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class UserRemovedSubscriber implements EventSubscriberInterface
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
            'user.removed' => [
                'onUserRemoved', 0
            ]
        ];
    }
    /**
     * @param UserRemovedEvent $event
     */
    public function onUserRemoved(UserRemovedEvent $event)
    {
        $this->logger->info($event->execute());
        $this->session->getFlashBag()->add('success', sprintf('The user %s is successfully removed', $event->getName()));
    }
}