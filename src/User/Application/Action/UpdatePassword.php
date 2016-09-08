<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\User\Application\Action;

use Black\User\Domain\Entity\User;
use Black\User\Infrastructure\CQRS\Handler\UpdatePasswordHandler;
use Black\User\Infrastructure\Password\Encoder;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;

/**
 * Class UpdatePassword
 */
class UpdatePassword
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
     * @param UpdatePasswordHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        UpdatePasswordHandler $handler,
        $commandName
    ) {
        $this->bus = $bus;
        $this->handler = $handler;
        $this->commandName = $commandName;
    }

    /**
     * @param User $user
     * @param $password
     */
    public function __invoke(User $user, $password)
    {
        $password = Encoder::encode($password);

        $this->bus->register($this->commandName, $this->handler);
        $this->bus->handle(new $this->commandName($user, $password));
    }
}
