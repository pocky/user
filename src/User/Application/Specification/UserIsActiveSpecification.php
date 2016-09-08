<?php

namespace Black\User\Application\Specification;

use Black\User\Domain\Entity\User;

/**
 * Class UserIsActiveSpecification
 */
class UserIsActiveSpecification
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function isSatisfiedBy(User $user) : bool
    {
        return (bool) true === $user->isActive();
    }
}
