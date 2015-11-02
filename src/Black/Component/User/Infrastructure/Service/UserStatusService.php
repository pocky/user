<?php

namespace Black\Component\User\Infrastructure\Service;

use Black\Component\User\Domain\Exception\UserNotFoundException;
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
     * @param UserId $userId
     *
     * @return mixed
     */
    public function activate(UserId $userId)
    {
        $user = $this->findUser($userId);

        $user->activate();
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param UserId $userId
     *
     * @return mixed
     */
    public function deactivate(UserId $userId)
    {
        $user = $this->findUser($userId);

        $user->deactivate();
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param UserId $userId
     *
     * @return mixed
     */
    public function lock(UserId $userId)
    {
        $user = $this->findUser($userId);

        $user->lock();
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param UserId $userId
     *
     * @return mixed
     */
    public function unlock(UserId $userId)
    {
        $user = $this->findUser($userId);

        $user->unlock();
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param UserId $userId
     *
     * @return mixed
     */
    public function connect(UserId $userId)
    {
        $user = $this->findUser($userId);

        $user->connect();
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param UserId $userId
     *
     * @return mixed
     */
    protected function findUser(UserId $userId)
    {
        $user = $this->repository->find($userId);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
