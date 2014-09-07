<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\User\Application\Specification;

use Black\Component\User\Domain\Model\User;
use Black\DDD\DDDinPHP\Application\Specification\Specification;

/**
 * Class UserIsActiveSpecification
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class UserIsActiveSpecification implements Specification
{
    /**
     * @param User $user
     *
     * @return bool
     */
    public function isSatisfiedBy(User $user)
    {
        return (bool) $user->isActive();
    }
}
