<?php

namespace Black\User\Infrastructure\Persistence\CQRS;

use Black\User\Domain\Model\UserId;
use Black\User\Domain\Repository\UserRepository;

/**
 * Class ReadRepository
 */
class ReadRepository
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function find(UserId $id)
    {
        return $this->repository->find($id);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }
}
