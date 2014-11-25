<?php

namespace spec\Black\Component\User\Application\DTOAssembler;

use Black\Component\User\Domain\Model\UserId;
use PhpSpec\ObjectBehavior;

class CreateUserAssemblerSpec extends ObjectBehavior
{
    protected $entityClass;

    protected $dtoClass;

    public function let()
    {
        $this->entityClass = 'Black\Component\User\Domain\Model\User';
        $this->dtoClass    = 'Black\Component\User\Application\DTO\CreateUserDTO';

        $this->beConstructedWith($this->entityClass, $this->dtoClass);
    }

    public function it_is_initializable()
    {
        $this->shouldImplement('Black\DDD\DDDinPHP\Application\DTO\Assembler');
    }

    public function it_should_transform()
    {
        $entity = new $this->entityClass(new UserId(1), 'test', 'test@test.com');
        $this->transform($entity)->shouldReturnAnInstanceOf($this->dtoClass);
    }

    public function it_should_reverseTransform()
    {
        $dto = new $this->dtoClass(1, 'test', 'test@test.com');
        $this->reverseTransform($dto)->shouldReturnAnInstanceOf($this->entityClass);
    }
}