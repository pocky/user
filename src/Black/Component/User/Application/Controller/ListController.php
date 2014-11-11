<?php
/*
 * This file is part of the ${FILE_HEADER_PACKAGE} package.
 *
 * ${FILE_HEADER_COPYRIGHT}
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\User\Application\Controller;

use Black\Component\User\Infrastructure\Service\UserReadService;

/**
 * Class ListController
 *
 * @author Alexandre Balmes <${COPYRIGHT_NAME}>
 * @license ${COPYRIGHT_LICENCE}
 */
class ListController
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
    public function listUsersAction()
    {
        $users = $this->service->findAll();

        return $users;
    }
} 