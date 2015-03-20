<?php

namespace Black\Component\User\Infrastructure\Service;

use Black\Component\User\Domain\Exception\UserNotFoundException;
use Black\Component\User\Domain\Model\User;
use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\Component\User\Infrastructure\Password\Encoder;
use Black\DDD\DDDinPHP\Infrastructure\Service\InfrastructureService;
use Email\EmailAddress;

/**
 * Class UserWriteService
 */
class UserWriteService extends UserService
{
    /**
     * @param UserId $userId
     *
     * @return mixed
     */
    public function connect(UserId $userId)
    {
        $user = $this->findUser($userId);

        $user->connect();
        $this->update($user);

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
        $this->update($user);

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
        $this->update($user);

        return $user;
    }
}
