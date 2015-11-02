<?php

namespace Black\Component\User\Infrastructure\Persistence\ORM;

use Black\Component\Common\Infrastructure\Persistence\ORM\EntityRepository;
use Black\Component\User\Domain\Model\UserWriteRepository;
use Black\Component\User\Domain\Model\User;

/**
 * Class WriteRepository
 */
class WriteRepository extends EntityRepository implements UserWriteRepository
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
     * Flushes all changes to objects that have been queued up to now to the database.
     * This effectively synchronizes the in-memory state of managed objects with the
     * database.
     */
    public function flush()
    {
        $this->manager->flush();
    }
}
