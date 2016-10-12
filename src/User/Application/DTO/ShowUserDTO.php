<?php

namespace Black\User\Application\DTO;

use Email\EmailAddress;

/**
 * Class ShowUserDTO
 */
class ShowUserDTO
{
    /**
     * @var
     */
    protected $id;

    /**
     * @var
     */
    protected $username;

    /**
     * @var EmailAddress
     */
    protected $email;

    /**
     * @param $id
     * @param $username
     * @param $email
     */
    public function __construct($id, $username, $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername() : string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmailAddress() : string
    {
        return $this->email;
    }
}
