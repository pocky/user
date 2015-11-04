<?php

namespace Black\Component\User\Infrastructure\Service;

use Black\Component\User\Domain\Exception\UserNotFoundException;
use Black\Component\User\Domain\Model\User;
use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Domain\Model\UserWriteRepository;

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
     * @var
     */
    protected $class;

    /**
     * @param UserWriteRepository $repository
     */
    public function __construct(UserWriteRepository $repository)
    {
        $this->repository = $repository;
        $this->class = $repository->getClassName();
    }

    /**
     * @param User $user
     * @return User
     */
    public function activate(User $user)
    {
        $user->activate();
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function deactivate(User $user)
    {
        $user->deactivate();
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function lock(User $user)
    {
        $user->lock();
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function unlock(User $user)
    {
        $user->unlock();
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function connect(User $user)
    {
        $user->connect();
        $this->repository->add($user);

        return $user;
    }
}
