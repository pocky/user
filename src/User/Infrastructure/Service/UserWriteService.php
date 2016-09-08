<?php

namespace Black\User\Infrastructure\Service;

use Black\User\Domain\Exception\UserNotFoundException;
use Black\User\Domain\Entity\User;
use Black\User\Domain\Entity\UserId;
use Black\User\Domain\Entity\UserRepository;
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
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->class = $repository->getClassName();
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

    /**
     * @param User $user
     * @param $password
     *
     * @return User
     */
    public function updatePassword(User $user, $password) : User
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
    protected function findUser(UserId $userId) : User
    {
        $user = $this->repository->find($userId);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
