<?php

namespace Black\User\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Email\EmailAddress;

/**
 * Class User
 */
class User
{
    /**
     * The UserId of the current User (a Value Object)
     *
     * @var UserId
     */
    protected $userId;

    /**
     * The username (use it for the authentication)
     *
     * @var
     */
    protected $username;

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
     * @param $username
     * @param EmailAddress $email
     */
    public function __construct(UserId $userId, $username, EmailAddress $email)
    {
        $this->userId = $userId;
        $this->username = $username;
        $this->email  = $email;
        $this->active = false;
        $this->locked = false;
    }

    /**
     * @return UserId
     */
    public function getUserId() : UserId
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * @return EmailAddress
     */
    public function getEmail() : EmailAddress
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
        $this->password = $password;
        $this->registeredAt = new \DateTime();
    }

    /**
     * @return bool
     */
    public function isActive() : bool
    {
        return (boolean) $this->active;
    }

    /**
     * @return bool
     */
    public function isLocked() : bool
    {
        return (boolean) $this->locked;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * @return \DateTime
     */
    public function getRegisteredAt() : \DateTime
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
     * @return Int
     */
    public function getNumberOfConnection() : Int
    {
        return (int) $this->numberOfConnection;
    }

    /**
     * @return \DateTime
     */
    public function getLastConnection() : \DateTime
    {
        return $this->lastConnection;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt() : \DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param $password
     */
    public function updatePassword($password)
    {
        $this->password = $password;
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @param $username
     * @param EmailAddress $address
     */
    public function updateAccount($username, EmailAddress $address)
    {
        $this->username = $username;
        $this->email = $address;
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
