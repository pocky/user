<?php
/*
 * This file is part of the ${FILE_HEADER_PACKAGE} package.
 *
 * ${FILE_HEADER_COPYRIGHT}
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Black\Bundle\UserBundle\Application\Command;

use Black\User\Domain\Entity\UserId;
use Black\User\Infrastructure\CQRS\Handler\RegisterUserHandler;
use Black\User\Infrastructure\Service\RegisterService;
use Black\DDD\CQRSinPHP\Infrastructure\CQRS\Bus;
use Email\EmailAddress;
use Rhumsaa\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateUserCommand
 */
class CreateUserCommand extends ContainerAwareCommand
{
    /**
     * @var RegisterService
     */
    protected $commandName;

    /**
     * @var \Symfony\Component\Translation\IdentityTranslator
     */
    protected $translator;

    /**
     * @var \Symfony\Component\Console\Helper\HelperInterface
     */
    protected $dialog;

    /**
     * @param Bus $bus
     * @param RegisterUserHandler $handler
     * @param $commandName
     */
    public function __construct(
        Bus $bus,
        RegisterUserHandler $handler,
        $commandName
    ) {
        $this->bus = $bus;
        $this->handler = $handler;
        $this->commandName = $commandName;

        parent::__construct();
    }

    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('black:user:create')
            ->setDescription('Create a new user')
            ->addArgument('username', InputArgument::OPTIONAL, 'The username')
            ->addArgument('email', InputArgument::OPTIONAL, 'The email')
            ->addArgument('password', InputArgument::OPTIONAL, 'The password');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        $question = $this->getHelperSet()->get('question');

        if (!$input->getArgument('username')) {
            $username = $question->askAndValidate(
                $output,
                'Please choose an username:',
                function ($username) {
                    if (empty($username)) {
                        throw new \InvalidArgumentException('Username can not be empty!');
                    }

                    return $username;
                }
            );

            $input->setArgument('username', $username);
        }

        if (!$input->getArgument('email')) {
            $email = $question->askAndValidate(
                $output,
                'Please choose an email:',
                function ($email) {
                    if (empty($email)) {
                        throw new \InvalidArgumentException('Email can not be empty!');
                    }

                    return $email;
                }
            );

            $input->setArgument('email', new EmailAddress($email));
        }

        if (!$input->getArgument('password')) {
            $password = $question->askHiddenResponse(
                $output,
                'Please choose an password:',
                function ($password) {
                    if (empty($password)) {
                        throw new \InvalidArgumentException('Password can not be empty!');
                    }

                    return $password;
                }
            );

            $input->setArgument('password', $password);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userId = new UserId(Uuid::uuid4());

        $this->bus->register($this->commandName, $this->handler);
        $this->bus->handle(new $this->commandName(
            $userId,
            $input->getArgument('username'),
            new EmailAddress($input->getArgument('email')),
            $input->getArgument('password')
        ));
    }
}
