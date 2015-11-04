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

use Black\Component\User\Domain\Model\User;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class UserNotFoundEvent
 */
class UserNotFoundEvent extends Event
{
    /**
     * @var
     */
    private $userId;

    /**
     * UserNotFoundEvent constructor.
     * @param $userId
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return User
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function message()
    {
        return "The user with UserId {$this->userId} was not found!.";
    }
}
