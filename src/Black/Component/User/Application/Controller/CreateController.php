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
use Black\Component\User\Infrastructure\CQRS\Handler\CreateUserHandler;
use Black\Component\User\Infrastructure\Service\RegisterService;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;

/**
 * Class CreateController
 *
 * @author Alexandre Balmes <${COPYRIGHT_NAME}>
 * @license ${COPYRIGHT_LICENCE}
 */
class CreateController
{
    /**
     * @var
     */
    protected $bus;

    /**
     * @var
     */
    protected $handler;

    /**
     * @var
     */
    protected $commandName;

    /**
     * @param Bus $bus
     * @param CreateUserHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        CreateUserHandler $handler,
        $commandName
    )
    {
        $this->bus         = $bus;
        $this->handler     = $handler;
        $this->commandName = $commandName;
    }

    /**
     * @return array
     */
    public function createUserAction(UserId $id, $name, $email)
    {
        $this->bus->register($this->commandName, $this->handler);
        $this->bus->handle(new $this->commandName($id, $name, $email));
    }
} 