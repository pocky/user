<?php

namespace Black\Component\User\Infrastructure\Service;

use Black\Component\User\Domain\Exception\UserNotFoundException;
use Black\Component\User\Domain\Model\User;
use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\DDD\DDDinPHP\Infrastructure\Service\InfrastructureService;

/**
 * Class UserStatusService
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class UserStatusService extends UserService
{
    /**
     * @var
     */
    protected $writeService;

    /**
     * @param UserManager     $manager
     * @param UserWriteService $userWriteService
     */
    public function __construct(
        UserManager $manager,
        UserWriteService $userWriteService
    ) {
        parent::__construct($manager);
        $this->writeService = $userWriteService;
    }

    /**
     * @param UserId $userId
     *
     * @return mixed
     */
    public function activate(UserId $userId)
    {
        $user = $this->findUser($userId);

        $user->activate();
        $this->writeService->update($user);

        return $user;
    }

    /**
     * @param UserId $userId
     *
     * @return mixed
     */
    public function deactivate(UserId $userId)
    {
        $user = $this->findUser($userId);

        $user->deactivate();
        $this->writeService->update($user);

        return $user;
    }

    /**
     * @param UserId $userId
     *
     * @return mixed
     */
    public function lock(UserId $userId)
    {
        $user = $this->findUser($userId);

        $user->lock();
        $this->writeService->update($user);

        return $user;
    }

    /**
     * @param UserId $userId
     *
     * @return mixed
     */
    public function unlock(UserId $userId)
    {
        $user = $this->findUser($userId);

        $user->unlock();
        $this->writeService->update($user);

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
        $this->writeService->update($user);

        return $user;
    }
}
