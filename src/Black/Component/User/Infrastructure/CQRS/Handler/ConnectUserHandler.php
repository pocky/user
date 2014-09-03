<?php

/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Black\Component\User\Infrastructure\CQRS\Handler;

use Black\Component\User\Infrastructure\CQRS\Command\ConnectUserCommand;
use Black\Component\User\Infrastructure\Doctrine\UserManager;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;

/**
 * Class ConnectUserHandler
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class ConnectUserHandler implements CommandHandler
{
    /**
     * @var UserManager
     */
    protected $manager;

    /**
     * @param UserManager $userManager
     */
    public function __construct(
        UserManager $userManager
    ) {
        $this->manager = $userManager;
    }

    /**
     * @param ConnectUserCommand $command
     */
    public function handle(ConnectUserCommand $command)
    {
        // TODO: write logic here
    }
}
