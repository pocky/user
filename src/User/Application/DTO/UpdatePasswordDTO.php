<?php

namespace Black\User\Application\DTO;

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
}
