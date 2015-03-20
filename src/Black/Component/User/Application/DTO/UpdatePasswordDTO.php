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
    private $id;

    /**
     * @var
     */
    private $password;

    /**
     * @param $id
     * @param $password
     */
    public function __construct($id, $password)
    {
        $this->id       = $id;
        $this->password = (string) $password;
    }

    /**
     * @return UserId
     */
    public function getId()
    {
       return $this->id;
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
            $this->id,
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
            $this->id,
            $this->password,
        ) = json_decode($serialized);
    }
}
