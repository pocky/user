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

use Black\Component\User\Domain\Model\User;
use Black\Component\User\Infrastructure\CQRS\Handler\UpdateAccountHandler;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;
use Email\EmailAddress;

/**
 * Class UpdateAccountController
 */
class UpdateAccountController
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
     * @param UpdateAccountHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        UpdateAccountHandler $handler,
        $commandName
    )
    {
        $this->bus         = $bus;
        $this->handler     = $handler;
        $this->commandName = $commandName;
    }

    /**
     * @param User $user
     * @param $name
     * @param EmailAddress $email
     */
    public function updateAccountAction(User $user, $name, EmailAddress $email)
    {
        $this->bus->register($this->commandName, $this->handler);
        $this->bus->handle(new $this->commandName($user, $name, $email));
    }
} 
