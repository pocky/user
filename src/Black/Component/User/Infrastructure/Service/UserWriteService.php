<?php

namespace Black\Component\User\Infrastructure\Service;

use Black\Component\User\Domain\Exception\UserNotFoundException;
use Black\Component\User\Domain\Model\User;
use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Domain\Model\UserWriteRepository;
use Email\EmailAddress;

/**
 * Class UserWriteService
 */
class UserWriteService
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
    public function connect(UserId $userId)
    {
        $user = $this->findUser($userId);

        $user->connect();
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param User $user
     * @param $password
     *
     * @return User
     */
    public function updatePassword(User $user, $password)
    {
        $user->updatePassword($password);
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param User $user
     * @param $name
     * @param EmailAddress $address
     * @return User
     */
    public function updateAccount(User $user, $name, EmailAddress $address)
    {
        $user->updateAccount($name, $address);
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param UserId $userId
     * @return mixed
     * @throws UserNotFoundException
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
