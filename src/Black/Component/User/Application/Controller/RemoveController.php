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

use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\CQRS\Handler\RemoveUserHandler;
use Black\Component\User\Infrastructure\Service\UserReadService;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;

/**
 * Class RemoveController
 *
 * @author Alexandre Balmes <${COPYRIGHT_NAME}>
 * @license ${COPYRIGHT_LICENCE}
 */
class RemoveController
{
    /**
     * @var Bus
     */
    protected $bus;

    /**
     * @var RemoveUserHandler
     */
    protected $handler;

    /**
     * @var
     */
    protected $commandName;

    /**
     * @param Bus $bus
     * @param RemoveUserHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        RemoveUserHandler $handler,
        $commandName
    ) {
        $this->bus = $bus;
        $this->handler = $handler;
        $this->commandName = $commandName;
    }

    /**
     * @param UserId $id
     */
    public function removeUserAction(UserId $id)
    {
        $this->bus->register($this->commandName, $this->handler);
        $this->bus->handle(new $this->commandName($id));
    }
} 