<?php

namespace Black\Component\User\Application\DTO;

use Black\Component\User\Domain\Model\UserId;

use Email\EmailAddress;

/**
 * Class ShowUserDTO
 */
class ShowUserDTO
{
    /**
     * @var UserId
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
        $this->id       = $id;
        $this->username = $username;
        $this->email    = $email;
    }

    /**
     * @return UserId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return EmailAddress
     */
    public function getEmailAddress()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return json_encode([
            'user' => [
                "id" => $this->id,
                "username" => $this->username,
                "email" => $this->email,
            ],
        ]);
    }

    /**
     * @param string $serialized
     * @return mixed
     */
    public function unserialize($serialized)
    {
        foreach (json_decode($serialized)->{'user'} as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }
}
