<?php

namespace Black\Component\User\Infrastructure\Service;

use Black\Component\User\Domain\Exception\UserNotFoundException;
use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\DDD\DDDinPHP\Infrastructure\Service\InfrastructureService;

/**
 * Class UserReadService
 *
 * @author Alexandre Balmes <${COPYRIGHT_NAME}>
 * @license ${COPYRIGHT_LICENCE}
 */
class UserReadService implements InfrastructureService
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
     * @param UserId $userId
     *
     * @return mixed
     */
    public function find(UserId $userId)
    {
        $user = $this->manager->find($userId);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    /**
     * @param $username
     * @return mixed
     */
    public function loadUser($username)
    {
        $user = $this->manager->loadUser($username);

        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function findAll()
    {
        return $this->manager->findAll();
    }
}
