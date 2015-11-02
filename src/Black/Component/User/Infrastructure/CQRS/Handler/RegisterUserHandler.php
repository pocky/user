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

use Black\Component\User\Infrastructure\CQRS\Command\RegisterUserCommand;
use Black\Component\User\Domain\Model\UserWriteRepository;
use Black\Component\User\Infrastructure\Service\RegisterService;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;

/**
 * Class RegisterUserHandler
 */
class RegisterUserHandler implements CommandHandler
{
    /**
     * @var UserWriteRepository
     */
    protected $repository;

    /**
     * @var RegisterService
     */
    protected $service;

    /**
     * @param UserWriteRepository $repository
     * @param RegisterService $service
     */
    public function __construct(
        UserWriteRepository $repository,
        RegisterService $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @param RegisterUserCommand $command
     */
    public function handle(RegisterUserCommand $command)
    {
        $user = $this->service->create($command->getUserId(), $command->getName(), $command->getEmail());

        if ($user) {
            $this->service->register($user, $command->getPassword());
            $this->repository->flush();
        }
    }
}
