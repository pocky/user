<?php

namespace Black\User\Domain\Repository;

use Black\User\Domain\Entity\User;
use Black\User\Domain\ValueObject\UserId;

/**
 * Interface UserRepository
 */
interface UserRepository
{
    public function loadUser($username);

    public function findAll();

    public function find(UserId $id);

    public function findBySlug($slug);

    public function add(User $user);

    public function remove(User $user);
}
