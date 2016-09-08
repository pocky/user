<?php

namespace Black\User\Application\Action;

use Black\User\Infrastructure\Service\UserReadService;

/**
 * Class ListUsers
 */
class ListUsers
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
     * @return array
     */
    public function __invoke()
    {
        $users = $this->service->findAll();

        return $users;
    }
}
