<?php

namespace Black\User\Infrastructure\Service;

use Black\User\Domain\Entity\User;
use Black\User\Domain\ValueObject\UserId;
use Black\User\Infrastructure\Password\Encoder;
use Black\User\Infrastructure\Persistence\CQRS\WriteRepository;
use Email\EmailAddress;

/**
 * Class RegisterService
 */
class RegisterService
{
    /**
     * @var
     */
    protected $repository;

    /**
     * @var
     */
    protected $class;

    /**
     * RegisterService constructor.
     * @param WriteRepository $repository
     * @param $entity
     */
    public function __construct(WriteRepository $repository, $entity)
    {
        $this->repository = $repository;
        $this->class = $entity;
    }

    /**
     * @param UserId $userId
     * @param $username
     * @param EmailAddress $email
     * @return User
     */
    public function create(UserId $userId, $username, EmailAddress $email) : User
    {
        $user = new $this->class($userId, $username, $email);
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param User $user
     * @param $password
     * @return User
     */
    public function register(User $user, $password) : User
    {
        $password = Encoder::encode($password);

        $user->register($password);
        $this->repository->add($user);

        return $user;
    }
}
