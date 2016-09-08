<?php

namespace Black\User\Application\Specification;

use Black\User\Domain\Entity\User;

/**
 * Class UserIsLockedSpecification
 */
class UserIsLockedSpecification
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function isSatisfiedBy(User $user) : bool
    {
        return (bool) true === $user->isLocked();
    }
}
