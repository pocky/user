<?php

namespace Black\User\Application\DTO;

/**
 * Class UnlockUserDTO
 */
final class UnlockUserDTO
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
