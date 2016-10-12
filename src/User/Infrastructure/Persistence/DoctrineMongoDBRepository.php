<?php
/*
 * This file is part of the ${FILE_HEADER_PACKAGE}.
 *
 * ${FILE_HEADER_COPYRIGHT}
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Black\User\Infrastructure\Persistence;

use Black\Bridge\Doctrine\Common\Persistence\MongoDB\MongoDBRepository;
use Black\User\Domain\Entity\User;
use Black\User\Domain\ValueObject\UserId;
use Black\User\Domain\Repository\UserRepository;
use Doctrine\ORM\NoResultException;

/**
 * Class DoctrineMongoDBRepository
 */
class DoctrineMongoDBRepository extends MongoDBRepository implements UserRepository
{
    /**
     * @param mixed $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function find(UserId $id)
    {
        $query = $this->getQueryBuilder()
            ->field('userId.value')->equals($id->getValue())
            ->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $exception) {
            return null;
        }
    }

    /**
     * @param $slug
     * @return null
     */
    public function findBySlug($slug)
    {
        $query = $this->getQueryBuilder()
            ->field('slug')->equals($slug)
            ->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $exception) {
            return null;
        }
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->getQueryBuilder()->getQuery();
    }


    /**
     * @param $username
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function loadUser($username)
    {
        $query = $this->getQueryBuilder()
            ->field('name')->equals($username)
            ->field('locked')->equals(false)
            ->getQuery();

        try {
            return $query->getSingleResult();
        } catch (NoResultException $exception) {
            return null;
        }
    }

    /**
     * @param User $user
     */
    public function add(User $user)
    {
        $this->manager->persist($user);
        $this->manager->flush();
    }

    /**
     * @param User $user
     */
    public function remove(User $user)
    {
        $this->manager->remove($user);
        $this->manager->flush();
    }
}
