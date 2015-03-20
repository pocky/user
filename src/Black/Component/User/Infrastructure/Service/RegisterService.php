<?php

namespace Black\Component\User\Infrastructure\Service;

use Black\Component\User\Domain\Model\User;
use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\Password\Encoder;
use Email\EmailAddress;

/**
 * Class RegisterService
 */
class RegisterService extends UserService
{
    /**
     * @param UserId $userId
     * @param        $username
     * @param        $email
     *
     * @return mixed
     */
    public function create(UserId $userId, $username, EmailAddress $email)
    {
        $user = $this->manager->createUser($userId, $username, $email);
        $this->manager->add($user);

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
        $this->update($user);

        return $user;
    }
}
