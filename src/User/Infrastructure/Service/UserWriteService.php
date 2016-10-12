<?php

namespace Black\User\Infrastructure\Service;

use Black\User\Domain\Exception\UserNotFoundException;
use Black\User\Domain\Entity\User;
use Black\User\Domain\ValueObject\UserId;
use Black\User\Domain\Entity\UserRepository;
use Black\User\Infrastructure\Persistence\CQRS\WriteRepository;
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
     * UserWriteService constructor.
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
