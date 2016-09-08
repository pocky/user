<?php

namespace Black\User\Application\DTO;

/**
 * Class LockUserDTO
 */
final class LockUserDTO
{
    /**
     * @var
     */
    private $id;

    /**
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId() : string
    {
        return $this->id;
    }
}
