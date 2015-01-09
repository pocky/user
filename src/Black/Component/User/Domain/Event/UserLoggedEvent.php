<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Black\Component\User\Domain\Event;

use Black\DDD\DDDinPHP\Infrastructure\DomainEvent\DomainEvent;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class UserLoggedEvent
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class UserLoggedEvent extends Event implements DomainEvent
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
        return "The user {$this->name} ({$this->userId}) is now logged in.";
    }
}