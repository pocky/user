<?php
/*
 * This file is part of the ${FILE_HEADER_PACKAGE}.
 *
 * ${FILE_HEADER_COPYRIGHT}
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Black\Component\User\Domain\Model;

/**
 * Interface UserWriteRepository
 */
interface UserWriteRepository
{
    public function add(User $user);

    public function remove(User $user);

    public function flush();
}
