<?php

namespace Black\User\Application\DTO;

/**
 * Class DisableUserDTO
 */
final class DisableUserDTO
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
    public function getId()
    {
        return $this->id;
    }
}
