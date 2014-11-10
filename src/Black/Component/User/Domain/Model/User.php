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

/**
 * Class User
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
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
     * The name (use it for the authentification)
     *
     * @var
     */
    protected $name;

    /**
     * The email (use it for the authentification and contact)
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
     * The salt is the random key usef for encoding raw password to password
     *
     * @var string
     */
    protected $salt;

    /**
     * The activity status of the user
     *
     * @var string
     */
    protected $active;

    /**
     * After errors on authentification or problems with the user, use it for disable the account
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
     * @param string $name
     * @param string $email
     */
    public function __construct(UserId $userId, $name, $email)
    {
        $this->userId = $userId;
        $this->name   = $name;
        $this->email  = $email;
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
        return (string) $this->email;
    }

    /**
     * This method will register the user but do not active the account
     *
     * @param $password
     * @param $salt
     */
    public function register($password, $salt)
    {
        $this->password     = $password;
        $this->salt         = $salt;
        $this->active       = false;
        $this->locked       = false;
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
    }

    /**
     *
     */
    public function disable()
    {
        $this->active = false;
    }

    /**
     *
     */
    public function lock()
    {
        $this->locked = true;
    }

    /**
     *
     */
    public function unlock()
    {
        $this->locked = false;
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
        return $this->salt;
    }
}
