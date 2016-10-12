<?php

namespace Black\User\Infrastructure\Service;

use Black\User\Domain\Entity\User;
use Black\User\Domain\Entity\UserRepository;
use Black\User\Infrastructure\Persistence\CQRS\WriteRepository;

/**
 * Class UserStatusService
 */
class UserStatusService
{
    /**
     * @var
     */
    protected $repository;

    /**
     * UserStatusService constructor.
     * @param WriteRepository $repository
     */
    public function __construct(WriteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param User $user
     * @return User
     */
    public function activate(User $user) : User
    {
        $user->activate();
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function deactivate(User $user) : User
    {
        $user->deactivate();
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function lock(User $user) : User
    {
        $user->lock();
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function unlock(User $user) : User
    {
        $user->unlock();
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function connect(User $user) : User
    {
        $user->connect();
        $this->repository->add($user);

        return $user;
    }
}
