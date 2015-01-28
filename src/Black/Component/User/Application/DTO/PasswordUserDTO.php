<?php

namespace Black\Component\User\Application\DTO;

use Black\Component\User\Domain\Model\UserId;
use Black\DDD\DDDinPHP\Application\DTO\DTO;

final class PasswordUserDTO implements DTO
{
    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var
     */
    private $password;

    /**
     * @var
     */
    private $passwordConfirm;

    /**
     * @param UserId $userId
     * @param $password
     * @param $passwordConfirm
     */
    public function __construct(UserId $userId, $password, $passwordConfirm)
    {
        $this->userId          = $userId;
        $this->password        = (string) $password;
        $this->passwordConfirm = (string) $passwordConfirm;
    }

    public function getUserId()
    {
       return $this->userId;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getPasswordConfirmation()
    {
        return $this->passwordConfirm;
    }

    public function serialize()
    {
        return json_encode([
            $this->userId,
            $this->password,
            $this->passwordConfirm
        ]);
    }

    public function unserialize($serialized)
    {
        return list(
            $this->userId,
            $this->password,
            $this->passwordConfirm
        ) = json_decode($serialized);
    }
}
