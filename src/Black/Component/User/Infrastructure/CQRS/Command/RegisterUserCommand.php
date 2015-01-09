<?php

/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\User\Infrastructure\CQRS\Command;

use Black\Component\User\Domain\Model\UserId;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;
use Email\EmailAddress;

/**
 * Class RegisterUserCommand
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
final class RegisterUserCommand implements Command
{
    /**
     * @var UserId
     */
    protected $userId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @param UserId $userId
     * @param $name
     * @param EmailAddress $email
     * @param $password
     */
    public function __construct(UserId $userId, $name, EmailAddress $email, $password)
    {
        $this->userId   = $userId;
        $this->name     = (string) $name;
        $this->email    = $email;
        $this->password = (string) $password;
    }

    /**
     * @return UserId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
