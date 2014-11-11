<?php

namespace Black\Component\User\Infrastructure\Service;

use Black\Component\User\Domain\Model\User;
use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\Password\Encoder;

/**
 * Class RegisterService
 *
 * @author Alexandre Balmes <${COPYRIGHT_NAME}>
 * @license ${COPYRIGHT_LICENCE}
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
    public function create(UserId $userId, $username, $email)
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
        $salt = sha1(uniqid().microtime().rand(0, 9999999));
        $password = Encoder::encode($password, $salt);

        $user->register($password, $salt);
        $this->update($user);

        return $user;
    }
}
