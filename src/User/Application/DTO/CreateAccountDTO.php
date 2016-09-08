<?php

namespace Black\User\Application\DTO;

/**
 * Class CreateAccountDTO
 */
final class CreateAccountDTO
{
    /**
     * @var
     */
    private $name;

    /**
     * @var
     */
    private $email;

    /**
     * @param $name
     * @param $email
     */
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail() : string
    {
        return $this->email;
    }
}
