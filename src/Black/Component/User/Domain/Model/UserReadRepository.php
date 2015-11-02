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

/**
 * Interface UserReadRepository
 */
interface UserReadRepository
{
    public function loadUser($username);

    public function findAll();

    public function find(UserId $id);

    public function findBySlug($slug);
}
