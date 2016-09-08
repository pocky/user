<?php

namespace Black\User\Application\DTO;

use Black\User\Domain\Entity\UserId;

/**
 * Class UpdatePasswordDTO
 */
final class UpdatePasswordDTO
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
        $this->id = $id;
        $this->password = (string) $password;
    }

    /**
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }
}
