<?php

/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\User\Infrastructure\Doctrine;

use Black\Component\Common\Infrastructure\Doctrine\CommonManager;
use Black\Component\User\Domain\Model\User;
use Black\Component\User\Domain\Model\UserId;

class UserManager extends CommonManager
{
    /**
     * @param UserId $id
     * @param string $username
     * @param string $email
     *
     * @return mixed
     */
    public function createUser(UserId $id, $username, $email)
    {
        $class = new $this->getClass();
        $user  = new $class($id, $username, $email);

        return $user;
    }

    /**
     * @param UserId $userId
     *
     * @return mixed
     */
    public function find(UserId $userId)
    {
        return $this->repository->findUserByUserId($userId);
    }

    /**
     * @param $username
     * @return mixed
     */
    public function loadUser($username)
    {
        return $this->repository->loadUser($username);
    }

    /**
     * @return array
     */
    public function findAl()
    {
        return $this->repository->findAll();
    }

    /**
     * @param User $user
     */
    public function add(User $user)
    {
        if (!$user instanceof $this->class) {
            throw new \InvalidArgumentException(gettype($user));
        }

        $this->manager->persist($user);
    }

    /**
     * @param User $user
     */
    public function remove(User $user)
    {
        if (!$user instanceof $this->class) {
            throw new \InvalidArgumentException(gettype($user));
        }

        $this->manager->remove($user);
    }
}
