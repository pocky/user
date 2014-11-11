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

use Black\DDD\DDDinPHP\Infrastructure\DomainEvent\DomainEvent;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class UserRemovedEvent
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class UserRemovedEvent extends Event implements DomainEvent
{
    /**
     * @var
     */
    private $userId;

    /**
     * @var
     */
    private $name;

    /**
     * @param $userId
     * @param $name
     */
    public function __construct($userId, $name)
    {
        $this->userId = $userId;
        $this->name   = $name;
    }

    /**
     * @return string
     */
    public function execute()
    {
        return sprintf('The user %s with %s identifier is terminated.', $this->name, $this->userId);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}