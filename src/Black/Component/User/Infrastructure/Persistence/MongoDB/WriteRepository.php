<?php

namespace Black\Component\User\Infrastructure\Persistence\MongoDB;

use Black\Component\Common\Infrastructure\Persistence\MongoDB\DocumentRepository;
use Black\Component\User\Domain\Model\UserWriteRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Black\Component\User\Domain\Model\User;
use Doctrine\ORM\NoResultException;

/**
 * Class WriteRepository
 */
class WriteRepository extends DocumentRepository implements UserWriteRepository
{
    /**
     * @param User $user
     */
    public function add(User $user)
    {
        $this->manager->persist($user);
    }

    /**
     * @param User $user
     */
    public function remove(User $user)
    {
        $this->manager->remove($user);
    }

    /**
     *
     */
    public function flush()
    {
        $this->manager->flush();
    }
}
