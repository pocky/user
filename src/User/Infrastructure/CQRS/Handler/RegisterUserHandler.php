<?php

namespace Black\User\Infrastructure\CQRS\Handler;

use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Command;
use Black\User\Infrastructure\Persistence\CQRS\WriteRepository;
use Black\User\Infrastructure\Service\RegisterService;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\CommandHandler;

/**
 * Class RegisterUserHandler
 */
class RegisterUserHandler implements CommandHandler
{
    /**
     * @var WriteRepository
     */
    protected $repository;

    /**
     * @var RegisterService
     */
    protected $service;

    /**
     * RegisterUserHandler constructor.
     *
     * @param WriteRepository $repository
     * @param RegisterService $service
     */
    public function __construct(
        WriteRepository $repository,
        RegisterService $service
    ) {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command)
    {
        $user = $this->service->create($command->getUserId(), $command->getName(), $command->getEmail());

        if ($user) {
            $this->service->register($user, $command->getPassword());
        }
    }
}
