<?php

namespace Black\Component\User\Application\DTO;

use Black\Component\User\Domain\Model\UserId;
use Black\DDD\DDDinPHP\Application\DTO\DTO;

/**
 * Class UpdatePasswordDTO
 */
final class UpdatePasswordDTO implements DTO
{
    /**
     * @var
     */
    private $userId;

    /**
     * @var
     */
    private $password;

    /**
     * @param $userId
     * @param $password
     */
    public function __construct($userId, $password)
    {
        $this->userId   = $userId;
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return json_encode([
            $this->userId,
            $this->password,
        ]);
    }

    /**
     * @param string $serialized
     * @return mixed
     */
    public function unserialize($serialized)
    {
        return list(
            $this->userId,
            $this->password,
        ) = json_decode($serialized);
    }
}
