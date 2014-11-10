<?php

namespace Black\Component\User\Infrastructure\Service;

use Black\Component\User\Domain\Exception\UserNotFoundException;
use Black\Component\User\Domain\Model\User;
use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\DDD\DDDinPHP\Infrastructure\Service\InfrastructureService;

/**
 * Class UserService
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
abstract class UserService implements InfrastructureService
{
    /**
     * @var UserManager
     */
    protected $manager;

    /**
     * @param UserManager $manager
     */
    public function __construct(UserManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param User $user
     */
    protected function update(User $user)
    {
        $this->manager->add($user);
    }

    /**
     * @param UserId $userId
     *
     * @return mixed
     */
    protected function findUser(UserId $userId)
    {
        $user = $this->manager->find($userId);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
