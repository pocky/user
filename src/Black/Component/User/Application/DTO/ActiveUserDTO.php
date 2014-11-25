<?php
/*
 * This file is part of the ${FILE_HEADER_PACKAGE} package.
 *
 * ${FILE_HEADER_COPYRIGHT}
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Black\Component\User\Application\DTO;

use Black\Component\User\Domain\Model\UserId;
use Black\DDD\DDDinPHP\Application\DTO\DTO;

/**
 * Class ActiveUserDTO
 *
 * @author Alexandre Balmes <${COPYRIGHT_NAME}>
 * @license ${COPYRIGHT_LICENCE}
 */
final class ActiveUserDTO implements DTO
{
    /**
     * @var
     */
    private $id;

    /**
     * @param $id
     */
    public function __construct(UserId $id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return json_encode([
            $this->id,
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        return list(
            $this->id,
        ) = json_decode($serialized);
    }
} 