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
}
