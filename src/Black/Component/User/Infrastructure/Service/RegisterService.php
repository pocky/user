<?php

namespace Black\Component\User\Infrastructure\Service;

use Black\Component\User\Domain\Model\User;
use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Domain\Model\UserWriteRepository;
use Black\Component\User\Infrastructure\Password\Encoder;
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
     * @param UserWriteRepository $repository
     */
    public function __construct(UserWriteRepository $repository)
    {
        $this->repository = $repository;
        $this->class = $repository->getClassName();
    }

    /**
     * @param UserId $userId
     * @param        $username
     * @param        $email
     *
     * @return mixed
     */
    public function create(UserId $userId, $username, EmailAddress $email)
    {
        $user = new $this->class($userId, $username, $email);
        $this->repository->add($user);

        return $user;
    }

    /**
     * @param User   $user
     * @param        $password
     *
     * @return mixed
     */
    public function register(User $user, $password)
    {
        $password = Encoder::encode($password);

        $user->register($password);
        $this->repository->add($user);

        return $user;
    }
}
