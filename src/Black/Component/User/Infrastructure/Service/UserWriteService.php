<?php

namespace Black\Component\User\Infrastructure\Service;

use Black\Component\User\Domain\Exception\UserNotFoundException;
use Black\Component\User\Domain\Model\User;
use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\Component\User\Infrastructure\Password\Encoder;
use Black\DDD\DDDinPHP\Infrastructure\Service\InfrastructureService;

/**
 * Class UserWriteService
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class UserWriteService extends UserService
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
     * @param UserId $userId
     * @param        $password
     *
     * @return mixed
     */
    public function register(UserId $userId, $password)
    {
        $user = $this->findUser($userId);
        $salt = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);

        $password = Encoder::encode($password, $salt);

        $user->register($password, $salt);
        $this->update($user);

        return $user;
    }

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
     * @param UserId $userId
     * @param        $password
     *
     * @return mixed
     */
    public function updatePassword(UserId $userId, $password)
    {
        $user = $this->findUser($userId);

        $user->updatePassword($password);
        $this->update($user);

        return $user;
    }
}
