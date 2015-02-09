<?php

/*
 *
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\User\Domain\Model;

use Black\DDD\DDDinPHP\Domain\Model\Repository;

/**
 * Interface UserRepository
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
interface UserRepository extends Repository
{
    public function findUserByUserId(UserId $userId);

    public function loadUser($username);

}
