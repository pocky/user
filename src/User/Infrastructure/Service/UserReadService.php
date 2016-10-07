<?php

namespace Black\User\Infrastructure\Service;

use Black\User\Domain\Exception\UserNotFoundException;
use Black\User\Domain\Entity\User;
use Black\User\Domain\Entity\UserId;
use Black\User\Infrastructure\Persistence\CQRS\ReadRepository;

/**
 * Class UserReadService
 */
class UserReadService
{
    /**
     * @var
     */
    private $repository;

    /**
     * UserReadService constructor.
     * @param ReadRepository $repository
     */
    public function __construct(ReadRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param UserId $userId
     * @return User
     */
    public function find(UserId $userId) : User
    {
        $user = $this->repository->find($userId);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    /**
     * @param $username
     * @return mixed
     */
    public function loadUser($username) : User
    {
        $user = $this->repository->loadUser($username);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->repository->findAll();
    }
}
