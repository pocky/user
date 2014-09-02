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
     * The UsierId of the current User (a Value Object)
     * @var UserId
     */
    protected $userId;

    /**
     * The username (use it for the authentification)
     *
     * @var
     */
    protected $username;

    /**
     * The email (use it for the authentification and contact)
     *
     * @var
     */
    protected $email;

    /**
     * The groups for the user
     *
     * @var ArrayCollection
     */
    protected $groups;

    /**
     * The roles for the user. It's an array of ROLE_* or FEATURE_*
     *
     * @var ArrayCollection
     */
    protected $roles;

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
     * This password should not be persisted (because he is in plaintext)
     *
     * @var string
     */
    protected $rawPassword;

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
     * @param string $username
     * @param string $email
     */
    public function __construct(UserId $userId, $username, $email)
    {
        $this->userId   = $userId;
        $this->username = $username;
        $this->email    = $email;
        $this->groups   = new ArrayCollection();
        $this->roles    = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @return ArrayCollection
     */
    public function getRoles()
    {
        return $this->roles;
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
    public function getUsername()
    {
        return (string) $this->username;
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
     * @param $rawPassword
     */
    public function register($rawPassword)
    {
        if (null !== $rawPassword) {
            $this->rawPassword = $rawPassword;
            $this->password    = $this->encodePassword();

            $this->eraseCredentials();
        }

        $this->active       = false;
        $this->locked       = false;
        $this->registeredAt = new \DateTime();

    }

    /**
     * This method will erase the sensitive data
     */
    public function eraseCredentials()
    {
        $this->rawPassword = null;
    }

    /**
     * This metod will encode the raw password to a secure one
     *
     * @return string
     */
    protected function encodePassword()
    {
        $this->salt = sha1(uniqid() . microtime() . rand(0, 9999999));
        $password   = sha1($this->salt . $this->rawPassword);

        return $password;
    }

    /**
     * @return string
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return string
     */
    public function isLocked()
    {
        return $this->locked;
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
        $this->lastConnection     = new \DateTime();
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
     * @param $rawPassword
     */
    public function updatePassword($rawPassword)
    {
        $this->rawPassword = $rawPassword;
        $this->password    = $this->encodePassword();

        $this->eraseCredentials();
        $this->updatedAt = new \DateTime();
    }
}
