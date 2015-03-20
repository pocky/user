<?php

/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\User\Domain\Model;

use Black\DDD\DDDinPHP\Domain\Model\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Email\EmailAddress;

/**
 * Class User
 */
class User implements Entity
{
    /**
     * The UserId of the current User (a Value Object)
     *
     * @var UserId
     */
    protected $userId;

    /**
     * The name (use it for the authentication)
     *
     * @var
     */
    protected $name;

    /**
     * The email (use it for the authentication and contact)
     *
     * @var
     */
    protected $email;

    /**
     * The encoded password. If you are able to reverse the password. There is a problem.
     *
     * @var string
     */
    protected $password;

    /**
     * The registration date
     *
     * @var \DateTime
     */
    protected $registeredAt;

    /**
     * The activity status of the user
     *
     * @var string
     */
    protected $active;

    /**
     * After errors on authentication or problems with the user, use it for disable the account
     *
     * @var string
     */
    protected $locked;

    /**
     * Number of connection of the users
     *
     * @var int
     */
    protected $numberOfConnection;

    /**
     * The last connection of the user
     *
     * @var \DateTime
     */
    protected $lastConnection;

    /**
     * The last account update
     *
     * @var
     */
    protected $updatedAt;

    /**
     * @param UserId $userId
     * @param $name
     * @param EmailAddress $email
     */
    public function __construct(UserId $userId, $name, EmailAddress $email)
    {
        $this->userId = $userId;
        $this->name   = $name;
        $this->email  = $email;
        $this->active = false;
        $this->locked = false;
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
        return (string) $this->name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * This method will register the user but do not active the account
     *
     * @param $password
     */
    public function register($password)
    {
        $this->password     = $password;
        $this->registeredAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function isActive()
    {
        return (boolean) $this->active;
    }

    /**
     * @return string
     */
    public function isLocked()
    {
        return (boolean) $this->locked;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return \DateTime
     */
    public function getRegisteredAt()
    {
        return $this->registeredAt;
    }

    /**
     *
     */
    public function activate()
    {
        $this->active = true;
        $this->updatedAt = new \DateTime();
    }

    /**
     *
     */
    public function lock()
    {
        $this->locked = true;
        $this->updatedAt = new \DateTime();
    }

    /**
     *
     */
    public function unlock()
    {
        $this->locked = false;
        $this->updatedAt = new \DateTime();
    }

    /**
     *
     */
    public function connect()
    {
        $this->numberOfConnection = $this->getNumberOfConnection() + 1;
        $this->lastConnection = new \DateTime();
    }

    /**
     * @return int
     */
    public function getNumberOfConnection()
    {
        return (int) $this->numberOfConnection;
    }

    /**
     * @return \DateTime
     */
    public function getLastConnection()
    {
        return $this->lastConnection;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param $password
     */
    public function updatePassword($password)
    {
        $this->password  = $password;
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @param $name
     * @param EmailAddress $address
     */
    public function updateAccount($name, EmailAddress $address)
    {
        $this->name      = $name;
        $this->email     = $address;
        $this->updatedAt = new \DateTime();
    }

    /**
     *
     */
    public function deactivate()
    {
        $this->active = false;
        $this->updatedAt = new \DateTime();
    }
}
