<?php

namespace Black\User\Domain\Entity;

/**
 * Class UserId
 */
class UserId
{
    /**
     * @var
     */
    protected $value;

    /**
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = (string) $value;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return (string) "{$this->getValue()}";
    }

    /**
     * @return mixed
     */
    public function getValue() : string
    {
        return $this->value;
    }

    /**
     * @param UserId $userId
     *
     * @return bool
     */
    public function isEqualTo(UserId $userId) : boolean
    {
        return $this->getValue() === $userId->getValue();
    }
}
