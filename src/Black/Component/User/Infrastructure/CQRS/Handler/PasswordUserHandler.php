<?php

namespace Black\Component\User\Infrastructure\CQRS\Handler;

use Black\Component\User\Domain\Exception\UserNotFoundException;
use Black\Component\User\Infrastructure\CQRS\Command\PasswordUserCommand;
use Black\Component\User\Infrastructure\Service\UserReadService;
use Black\Component\User\Infrastructure\Service\UserWriteService;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;

/**
 * Class PasswordUserHandler
 */
class PasswordUserHandler implements CommandHandler
{
    /**
     * @var UserReadService
     */
    protected $readService;

    /**
     * @var UserWriteService
     */
    protected $writeService;

    /**
     * @param UserReadService $readService
     * @param UserWriteService $writeService
     */
    public function __construct(
        UserReadService $readService,
        UserWriteService $writeService
    ) {
        $this->readService = $readService;
        $this->writeService = $writeService;

    }

    /**
     * @param PasswordUserCommand $command
     */
    public function handle(PasswordUserCommand $command)
    {
        $user = $this->readService->find($command->getUserId());

        if (!$user) {
            throw new UserNotFoundException();
        }

        if ($command->getPassword() === $command->getPasswordConfirmation()) {
            $this->writeService->updatePassword($user, $command->getPassword());
        }
    }
}
