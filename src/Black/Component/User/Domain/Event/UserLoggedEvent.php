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
 * Class UserActivateEvent
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class UserActivatedEvent extends Event implements DomainEvent
{
    /**
     * @var
     */
    private $userId;

    /**
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function execute()
    {
        return sprintf('The user %s is now activated.', $this->userId);
    }

    /**
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }
}