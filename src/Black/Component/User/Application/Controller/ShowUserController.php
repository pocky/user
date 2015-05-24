<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\User\Application\Controller;

use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\Service\UserReadService;

/**
 * Class ShowUserController
 */
class ShowUserController
{
    /**
     * @var UserReadService
     */
    protected $service;

    /**
     * @param UserReadService $service
     */
    public function __construct(UserReadService $service)
    {
        $this->service = $service;
    }

    /**
     * @param UserId $userId
     * @return mixed
     */
    public function showUserAction(UserId $userId)
    {
        $user = $this->service->find($userId);

        return $user;
    }
} 
