<?php

namespace Black\Component\User\Infrastructure\Service;

use Black\Component\User\Domain\Exception\UserNotFoundException;
use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Domain\Model\UserReadRepository;

/**
 * Class UserReadService
 */
class UserReadService
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
     * @param UserReadRepository $repository
     */
    public function __construct(UserReadRepository $repository)
    {
        $this->repository = $repository;
        $this->class = $repository->getClassName();
    }

    /**
     * @param UserId $userId
     *
     * @return mixed
     */
    public function find(UserId $userId)
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
    public function loadUser($username)
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
