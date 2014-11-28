<?php
/*
 * This file is part of the Black package.
 *
 * (c) Alexandre Balmes <alexandre@lablackroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Black\Component\User\Application\DTOAssembler;

use Black\Component\User\Domain\Model\UserId;
use Black\Component\User\Infrastructure\Password\Encoder;
use Black\DDD\DDDinPHP\Application\DTO\DTO;
use Black\DDD\DDDinPHP\Application\DTO\Assembler;
use Black\DDD\DDDinPHP\Domain\Model\Entity;
use Symfony\Component\Security\Core\Tests\Encoder\PasswordEncoder;

/**
 * Class CreateUserAssembler
 *
 * @author  Alexandre 'pocky' Balmes <alexandre@lablackroom.com>
 * @license http://opensource.org/licenses/mit-license.php MIT
 */
class CreateUserAssembler implements Assembler
{
    /**
     * @var
     */
    protected $entityClass;
    
    /**
     * @var
     */
    protected $dtoClass;
    
    /**
     * @param $entityClass
     * @param $dtoClass
     */
    public function __construct($entityClass, $dtoClass)
    {
        $this->entityClass = $entityClass;
        $this->dtoClass    = $dtoClass;
    }

    /**
     * @param  Entity $user
     * @return mixed
     */
    public function transform(Entity $user)
    {
        $this->verify($user, $this->entityClass);

        $dto = new $this->dtoClass(
            $user->getUserId(),
            $user->getName(),
            $user->getEmail()
        );

        return $dto;
    }

    /**
     * @param DTO $createUserDTO
     * @return mixed
     * @throws \Exception
     */
    public function reverseTransform(DTO $createUserDTO)
    {
        $this->verify($createUserDTO, $this->dtoClass);

        $userDTO = new UserId($createUserDTO->getId());

        $user = new $this->entityClass(
            $userDTO,
            $createUserDTO->getName(),
            $createUserDTO->getEmail()
        );

        return $user;
    }

    /**
     * @param $object
     * @param $class
     *
     * @throws \Exception
     */
    protected function verify($object, $class)
    {
        if (!$object instanceof $class) {
            throw new \Exception();
        }
    }
}
