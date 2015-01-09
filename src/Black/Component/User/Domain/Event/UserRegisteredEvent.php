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
 * Class UserRegisteredEvent
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class UserRegisteredEvent extends Event implements DomainEvent
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
     * @var
     */
    private $email;

    /**
     * @param $userId
     * @param $name
     * @param $email
     */
    public function __construct($userId, $name, $email)
    {
        $this->userId = $userId;
        $this->name   = $name;
        $this->email  = $email;
    }

    /**
     * @return string
     */
    public function execute()
    {
        return sprintf('The user %s (%s) with %s identifier is registered.', $this->name, $this->email, $this->userId);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }
}