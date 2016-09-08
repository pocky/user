<?php

namespace Black\User\Application\Action;

use Black\User\Domain\Entity\UserId;
use Black\User\Infrastructure\Service\UserReadService;

/**
 * Class ShowUser
 */
class ShowUser
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
    public function __invoke(UserId $userId)
    {
        $user = $this->service->find($userId);

        return $user;
    }
}
