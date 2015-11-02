<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Black\Component\User\Application\DTO;



/**
 * Class UpdateAccountDTO
 */
final class UpdateAccountDTO
{
    /**
     * @var
     */
    protected $id;

    /**
     * @var
     */
    private $name;

    /**
     * @var
     */
    private $email;

    /**
     * @param $id
     * @param $name
     * @param $email
     */
    public function __construct($id, $name, $email)
    {
        $this->id    = $id;
        $this->name  = $name;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return json_encode([
                $this->name,
                $this->email,
            ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        return list(
            $this->name,
            $this->email
        ) = json_decode($serialized);
    }
}
