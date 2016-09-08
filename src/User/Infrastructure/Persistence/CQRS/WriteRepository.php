<?php

namespace Black\User\Infrastructure\Persistence\CQRS;

use Black\User\Domain\Entity\User;
use Black\User\Domain\Repository\UserRepository;

/**
 * Class WriteRepository
 */
class WriteRepository
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function add(User $user)
    {
        $this->repository->add($user);
    }

    public function update(User $user)
    {
        $this->repository->update($user);
    }
}
